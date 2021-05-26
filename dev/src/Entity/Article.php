<?php namespace Application\Entity;

use Atomino\Atoms\Entity\_Article;
use Atomino\Carbon\Attributes\BelongsToMany;
use Atomino\Carbon\Attributes\HasMany;
use Atomino\Carbon\Attributes\Modelify;
use Atomino\Carbon\Plugins\Attachment\Attachmentable;
use Atomino\Carbon\Plugins\Attachment\AttachmentCollection;
use Atomino\Carbon\Plugins\Comment\Commentable;
use Atomino\Carbon\Plugins\Guid\Guid;

#[Modelify(\Application\Database\DefaultConnection::class, 'article', true)]
#[BelongsToMany('related', Article::class, 'relatedIds')]
#[Attachmentable()]
#[Guid()]
#[AttachmentCollection(field: 'image', maxSize: 512 * 1024, mimetype: "/image\/.*/")]
#[AttachmentCollection(field: 'head', maxCount: 1, maxSize: 512 * 1024, mimetype: "/image\/.*/")]
#[AttachmentCollection(field: 'file')]
#[HasMany('comments', ArticleComment::class, 'hostId')]
#[Commentable(ArticleComment::class, User::class)]
class Article extends _Article {
}