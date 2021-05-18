<?php namespace Application\Entity;

use Atomino\Entity\Attributes\Modelify;
use Atomino\Atoms\Entity\_Product;

#[Modelify(\Application\Database\DefaultConnection::class, 'product', true)]
class Product extends _Product{

}