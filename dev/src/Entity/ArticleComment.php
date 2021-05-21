<?php namespace Application\Entity;

use Atomino\Entity\Attributes\BelongsTo;
use Atomino\Entity\Attributes\Modelify;
use Atomino\Atoms\Entity\_ArticleComment;
use Atomino\Molecules\EntityPlugin\Created\Created;
use Atomino\Molecules\Module\Comment\CommentInterface;

#[Modelify(\Application\Database\DefaultConnection::class, 'article_comment', true)]
#[BelongsTo('host', Article::class, 'hostId')]
#[Created]
class ArticleComment extends _ArticleComment implements CommentInterface {

}
