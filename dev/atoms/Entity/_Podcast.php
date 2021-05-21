<?php namespace Atomino\Atoms\Entity;

use Atomino\Database\Finder\Filter;
use Atomino\Entity\Attributes\Field;
use Atomino\Entity\Attributes\Immutable;
use Atomino\Entity\Attributes\Protect;
use Atomino\Entity\Attributes\Validator;
use Atomino\Entity\Entity;
use Atomino\Entity\Model;
use Atomino\Entity\Attributes\RequiredField;


/**
 * @method static \Atomino\Atoms\EntityFinder\_Podcast search( Filter $filter = null )
 * @method static \Atomino\Database\Finder\Comparison id($isin = null)
 * @property-read int|null $id
 * @method static \Atomino\Database\Finder\Comparison length($isin = null)
 * @method static \Atomino\Database\Finder\Comparison name($isin = null)
 */
#[RequiredField('id', \Atomino\Entity\Field\IntField::class)]
#[Field("id", \Atomino\Entity\Field\IntField::class)]
#[Protect("id", true, false)]
#[Immutable("id",false)]
#[Field("length", \Atomino\Entity\Field\IntField::class)]
#[Validator("name", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>255])]
#[Field("name", \Atomino\Entity\Field\StringField::class)]
abstract class _Podcast extends Entity {
	static null|Model $model = null;
	const id = 'id';
	protected int|null $id = null;
	protected function getId():int|null{ return $this->id;}
	const length = 'length';
	public int|null $length = null;
	const name = 'name';
	public string|null $name = null;
}





