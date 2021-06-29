<?php namespace Application\Entity;

use Atomino\Carbon\Attributes\Modelify;
use Application\Atoms\Entity\_Article;

#[Modelify(\Application\Database\DefaultConnection::class, 'article', true)]
class Article extends _Article{

}