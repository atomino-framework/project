<?php namespace Application\Entity;

use Atomino\Database\Connection;
use Atomino\Database\Finder\Filter;
use Atomino\Entity\Attributes\BelongsToMany;
use Atomino\Entity\Attributes\EventHandler;
use Atomino\Entity\Attributes\Modelify;
use Atomino\Atoms\Entity\_Article;
use Atomino\Entity\Entity;
use Atomino\Molecules\EntityPlugin\Attachmentable\Attachmentable;
use Atomino\Molecules\EntityPlugin\Attachmentable\Attributes\AttachmentCollection;
use Atomino\Molecules\EntityPlugin\Guid\Guid;
use Atomino\Neutrons\Attr;

#[Modelify(\Application\Database\DefaultConnection::class, 'article', true)]
#[BelongsToMany('related', Article::class, 'relatedIds')]
#[Attachmentable()]
#[Guid()]
#[AttachmentCollection(field: 'image', maxSize: 512 * 1024, mimetype: "/image\/.*/")]
#[AttachmentCollection(field: 'head', maxCount: 1, maxSize: 512 * 1024, mimetype: "/image\/.*/")]
#[AttachmentCollection(field: 'file')]
#[Comments()]
class Article extends _Article implements Commentable {
	use CommentHost;
}

interface Commentable {

	const COMMENT_MODIFIED = "COMMENT_MODIFIED";
	const COMMENTS_RECALCULATED = "COMMENTS_RECALCULATED";

	public function areCommentsVisible(): bool;
	public function canComment(): bool;
	public function isCommentModerator(): bool;
	public function addComment(string $text, int|null $replyId = null): bool;
	public function deleteComment(int $id): bool;
	public function hideComment(int $id): bool;
	public function unHideComment(int $id): bool;
}

trait CommentHost {

	static CommentStore|null $commentStore = null;

	public function getCommentStore() {
		if (is_null(static::$commentStore)) {
			$c = Comments::get(new \ReflectionClass($this));
			static::$commentStore = new CommentStore(
				$c->connection ?? static::$model->getConnection(),
				$c->connection ?? static::$model->getTable() . '_comments',
				$c->commentCacheField ?? 'commentCache',
				$c->botId,
			);
		}
		return static::$commentStore;
	}

	protected function getCommenter(): User|null { return User::pick(1); }

	public function areCommentsVisible(): bool { return true; }
	public function canComment(): bool { return true; }
	public function isCommentModerator(): bool { return true; }
	public function canDeleteComment($id): bool { return $this->isCommentModerator(); }

	public function deleteComment(int $id): bool {
		if ($this->canDeleteComment($id)) {
			$this->getCommentStore()->delete($id);
			$this->handleEvent(Commentable::COMMENTMODIFIED);
			return true;
		} else return false;
	}
	public function hideComment(int $id): bool {
		if ($this->isCommentModerator()) {
			$this->getCommentStore()->hide($id);
			$this->handleEvent(Commentable::COMMENT_MODIFIED);
			return true;
		} else return false;
	}
	public function unHideComment(int $id): bool {
		if ($this->isCommentModerator()) {
			$this->getCommentStore()->unHide($id);
			$this->handleEvent(Commentable::COMMENT_MODIFIED);
			return true;
		} else return false;
	}
	public function addComment(string $text, int|null $replyId = null, bool $asBot = false): bool {
		if ($this->canComment()) {
			$this->getCommentStore()->add($this->getCommenter()->id, $text, $replyId, $this->isCommentModerator() && $asBot);
			$this->handleEvent(Commentable::COMMENT_MODIFIED);
			return true;
		} else return false;
	}

	public function getComment(int $id) { return $this->getCommentStore()->get($id, $this->isCommentModerator()); }
	public function getComments(int $id, int $page, int $limit) { return $this->getCommentStore()->getPage($id, $page, $limit, $this->isCommentModerator()); }

	#[EventHandler(Commentable::COMMENT_MODIFIED)]
	protected function recalculateComments() {
		// count-public, count, last comment id, updated, updated-public
		$data = [];
		$this->handleEvent(Commentable::COMMENTS_RECALCULATED, $data);
		$this->save();
	}
}


#[\Attribute]
class Comments extends Attr {
	public function __construct(
		public string|null $table = null,
		public string|null $commentCacheField = null,
		public Connection|null $connection = null,
		public int|null $botId = null
	) {
	}
}

class CommentStore {
	public function __construct(public Connection $connection, public string $table, public string $cacheField, public int|null $botId) { }
	public function add(int $userId, string $text, int|null $replId, bool $asBot) { }
	public function delete(int $id) { $this->connection->getSmart()->delete($this->table, Filter::where('id=$1', $id)); }
	public function hide(int $id) { $this->connection->getSmart()->update($this->table, Filter::where('id=$1', $id), ['hidden' => true]); }
	public function unHide(int $id) { $this->connection->getSmart()->update($this->table, Filter::where('id=$1', $id), ['hidden' => false]); }
	public function get(int $id, bool $hidden = false): array {
		return $this->connection->getFinder()
		                        ->table($this->table)
		                        ->where(Filter::where('id=$1', $id)->and($hidden ? false : "hidden=$1", 0))
		                        ->record()
			;
	}
	public function getPage(int $id, int $limit, int $page, bool $hidden = false): array {
		return $this->connection->getFinder()
		                        ->table($this->table)
		                        ->where(Filter::where($hidden ? false : "hidden=$1", 0))
		                        ->desc('date')
		                        ->records()
			;
	}
}

class Comment {
	public string $text;
	public int $userId;
	public bool $asBot = false;
	public function __construct(array $data) { }
}