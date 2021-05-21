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
 * @method static \Atomino\Atoms\EntityFinder\_ArticleComment search( Filter $filter = null )
 * @method static \Atomino\Database\Finder\Comparison asId($isin = null)
 * @method static \Atomino\Database\Finder\Comparison created($isin = null)
 * @property-read \DateTime|null $created
 * @method static \Atomino\Database\Finder\Comparison hostId($isin = null)
 * @method static \Atomino\Database\Finder\Comparison id($isin = null)
 * @property-read int|null $id
 * @method static \Atomino\Database\Finder\Comparison replyId($isin = null)
 * @method static \Atomino\Database\Finder\Comparison status($isin = null)
 * @method static \Atomino\Database\Finder\Comparison text($isin = null)
 * @method static \Atomino\Database\Finder\Comparison userId($isin = null)
 * @property-read \Application\Entity\Article $host
 */
#[RequiredField('id', \Atomino\Entity\Field\IntField::class)]
#[Immutable("created", true)]
#[Protect("created", true, false)]
#[RequiredField("created", \Atomino\Entity\Field\DateTimeField::class)]
#[Validator("asId", \Symfony\Component\Validator\Constraints\PositiveOrZero::class)]
#[Field("asId", \Atomino\Entity\Field\IntField::class)]
#[Field("created", \Atomino\Entity\Field\DateTimeField::class)]
#[Validator("hostId", \Symfony\Component\Validator\Constraints\PositiveOrZero::class)]
#[Field("hostId", \Atomino\Entity\Field\IntField::class)]
#[Field("id", \Atomino\Entity\Field\IntField::class)]
#[Protect("id", true, false)]
#[Immutable("id",false)]
#[Validator("replyId", \Symfony\Component\Validator\Constraints\PositiveOrZero::class)]
#[Field("replyId", \Atomino\Entity\Field\IntField::class)]
#[Field("status", \Atomino\Entity\Field\BoolField::class)]
#[Validator("text", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>65535])]
#[Field("text", \Atomino\Entity\Field\StringField::class)]
#[Validator("userId", \Symfony\Component\Validator\Constraints\PositiveOrZero::class)]
#[Field("userId", \Atomino\Entity\Field\IntField::class)]
abstract class _ArticleComment extends Entity {
	static null|Model $model = null;
	use \Atomino\Molecules\EntityPlugin\Created\CreatedTrait;
	const asId = 'asId';
	public int|null $asId = null;
	const created = 'created';
	protected \DateTime|null $created = null;
	protected function getCreated():\DateTime|null{ return $this->created;}
	const hostId = 'hostId';
	public int|null $hostId = null;
	const id = 'id';
	protected int|null $id = null;
	protected function getId():int|null{ return $this->id;}
	const replyId = 'replyId';
	public int|null $replyId = null;
	const status = 'status';
	public bool|null $status = null;
	const text = 'text';
	public string|null $text = null;
	const userId = 'userId';
	public int|null $userId = null;
}





