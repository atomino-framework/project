<?php namespace Application\Entity;

use Atomino\Carbon\Attributes\BelongsTo;
use Atomino\Carbon\Attributes\Modelify;
use Atomino\Atoms\Entity\_ArticleComment;
use Atomino\Carbon\Plugins\Created\Created;
use Atomino\Bundle\Comment\CommentInterface;

#[Modelify(\Application\Database\DefaultConnection::class, 'article_comment', true)]
#[BelongsTo('host', Article::class, 'hostId')]
#[Created]
class ArticleComment extends _ArticleComment implements CommentInterface {

}
