<?php namespace Application\Entity;

use Atomino\Carbon\Attributes\Modelify;
use Atomino\Atoms\Entity\_Podcast;

#[Modelify(\Application\Database\DefaultConnection::class, 'podcast', true)]
class Podcast extends _Podcast{

}