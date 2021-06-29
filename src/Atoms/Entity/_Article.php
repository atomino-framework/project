<?php namespace Application\Atoms\Entity;

use Atomino\Carbon\Database\Finder\Filter;
use Atomino\Carbon\Attributes\Field;
use Atomino\Carbon\Attributes\Immutable;
use Atomino\Carbon\Attributes\Protect;
use Atomino\Carbon\Attributes\Validator;
use Atomino\Carbon\Entity;
use Atomino\Carbon\Model;
use Atomino\Carbon\Attributes\RequiredField;


/**
 * @method static Application\Atoms\EntityFinder\_Article search( Filter $filter = null )
 * @method static \Atomino\Carbon\Database\Finder\Comparison body($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison id($isin = null)
 * @property-read int|null $id
 * @method static \Atomino\Carbon\Database\Finder\Comparison title($isin = null)
 */
#[RequiredField('id', \Atomino\Carbon\Field\IntField::class)]
#[Validator("body", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>65535])]
#[Field("body", \Atomino\Carbon\Field\StringField::class)]
#[Field("id", \Atomino\Carbon\Field\IntField::class)]
#[Protect("id", true, false)]
#[Immutable("id",false)]
#[Validator("title", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>512])]
#[Field("title", \Atomino\Carbon\Field\StringField::class)]
abstract class _Article extends Entity {
	static null|Model $model = null;
	const body = 'body';
	public string|null $body = null;
	const id = 'id';
	protected int|null $id = null;
	protected function getId():int|null{ return $this->id;}
	const title = 'title';
	public string|null $title = null;
}





