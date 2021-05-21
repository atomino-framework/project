<?php namespace Application\Entity;

use Atomino\Atoms\Entity\_Article;
use Atomino\Entity\Attributes\BelongsToMany;
use Atomino\Entity\Attributes\HasMany;
use Atomino\Entity\Attributes\Modelify;
use Atomino\Molecules\EntityPlugin\Attachmentable\Attachmentable;
use Atomino\Molecules\EntityPlugin\Attachmentable\Attributes\AttachmentCollection;
use Atomino\Molecules\EntityPlugin\Commentable\Commentable;
use Atomino\Molecules\EntityPlugin\Guid\Guid;

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