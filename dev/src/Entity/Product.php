<?php namespace Application\Entity;

use Atomino\Carbon\Attributes\Modelify;
use Atomino\Atoms\Entity\_Product;

#[Modelify(\Application\Database\DefaultConnection::class, 'product', true)]
class Product extends _Product{

}