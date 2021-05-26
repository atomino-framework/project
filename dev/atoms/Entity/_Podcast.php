<?php namespace Atomino\Atoms\Entity;

use Atomino\Carbon\Database\Finder\Filter;
use Atomino\Carbon\Attributes\Field;
use Atomino\Carbon\Attributes\Immutable;
use Atomino\Carbon\Attributes\Protect;
use Atomino\Carbon\Attributes\Validator;
use Atomino\Carbon\Entity;
use Atomino\Carbon\Model;
use Atomino\Carbon\Attributes\RequiredField;


/**
 * @method static \Atomino\Atoms\EntityFinder\_Podcast search( Filter $filter = null )
 * @method static \Atomino\Carbon\Database\Finder\Comparison id($isin = null)
 * @property-read int|null $id
 * @method static \Atomino\Carbon\Database\Finder\Comparison length($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison name($isin = null)
 */
#[RequiredField('id', \Atomino\Carbon\Field\IntField::class)]
#[Field("id", \Atomino\Carbon\Field\IntField::class)]
#[Protect("id", true, false)]
#[Immutable("id",false)]
#[Field("length", \Atomino\Carbon\Field\IntField::class)]
#[Validator("name", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>255])]
#[Field("name", \Atomino\Carbon\Field\StringField::class)]
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





