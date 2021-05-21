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
 * @method static \Atomino\Atoms\EntityFinder\_User search( Filter $filter = null )
 * #[Immutable( 'guid', true )]
 * #[Protect( 'guid', true, false )]
 * #[RequiredField('guid', StringField::class)]
 * @property-read \Atomino\Molecules\Module\Attachment\Collection $avatar
 * @method static \Atomino\Database\Finder\Comparison attachments($isin = null)
 * @method static \Atomino\Database\Finder\Comparison created($isin = null)
 * @property-read \DateTime|null $created
 * @method static \Atomino\Database\Finder\Comparison email($isin = null)
 * @method static \Atomino\Database\Finder\Comparison group($isin = null)
 * @method static \Atomino\Database\Finder\Comparison guid($isin = null)
 * @method static \Atomino\Database\Finder\Comparison id($isin = null)
 * @property-read int|null $id
 * @method static \Atomino\Database\Finder\Comparison name($isin = null)
 * @property string|null $name
 * @method static \Atomino\Database\Finder\Comparison password($isin = null)
 * @property-read string|null $password
 * @method static \Atomino\Database\Finder\Comparison updated($isin = null)
 * @property-read \DateTime|null $updated
 */
#[RequiredField('id', \Atomino\Entity\Field\IntField::class)]
#[Immutable("created", true)]
#[Protect("created", true, false)]
#[RequiredField("created", \Atomino\Entity\Field\DateTimeField::class)]
#[Protect("updated", true, false)]
#[RequiredField("updated", \Atomino\Entity\Field\DateTimeField::class)]
#[Immutable( 'attachments', true )]
#[Protect( 'attachments', false, false )]
#[RequiredField( 'attachments', \Atomino\Entity\Field\JsonField::class )]
#[Protect("password", true, false)]
#[RequiredField("email", \Atomino\Entity\Field\StringField::class)]
#[RequiredField("password", \Atomino\Entity\Field\StringField::class)]
#[Field("attachments", \Atomino\Entity\Field\JsonField::class)]
#[Field("created", \Atomino\Entity\Field\DateTimeField::class)]
#[Validator("email", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>255])]
#[Field("email", \Atomino\Entity\Field\StringField::class)]
#[Validator("group", \Symfony\Component\Validator\Constraints\Choice::class, ['multiple'=>false,'choices'=>['admin','moderator','visitor']])]
#[Field("group", \Atomino\Entity\Field\EnumField::class, ['admin','moderator','visitor'])]
#[Validator("guid", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>36])]
#[Field("guid", \Atomino\Entity\Field\StringField::class)]
#[Field("id", \Atomino\Entity\Field\IntField::class)]
#[Protect("id", true, false)]
#[Immutable("id",false)]
#[Validator("name", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>16])]
#[Field("name", \Atomino\Entity\Field\StringField::class)]
#[Validator("password", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>128])]
#[Field("password", \Atomino\Entity\Field\StringField::class)]
#[Field("updated", \Atomino\Entity\Field\DateTimeField::class)]
abstract class _User extends Entity implements \Atomino\Molecules\Module\Attachment\AttachmentableInterface, \Atomino\Molecules\Module\Authenticator\AuthenticableInterface, \Atomino\Molecules\Module\Authorizable\AuthorizableInterface{
	static null|Model $model = null;
	use \Atomino\Molecules\EntityPlugin\Guid\GuidTrait;
	use \Atomino\Molecules\EntityPlugin\Created\CreatedTrait;
	use \Atomino\Molecules\EntityPlugin\Updated\UpdatedTrait;
	use \Atomino\Molecules\EntityPlugin\Attachmentable\AttachmentableTrait;
	protected final function __getAvatar(){return $this->getAttachmentCollection("avatar");}
	use \Atomino\Molecules\EntityPlugin\Authenticable\AuthenticableTrait;
	use \Atomino\Molecules\EntityPlugin\Authorizable\AuthorizableTrait;
	const ROLE_EDIT = "edit";
	const ROLE_MODERATE = "moderate";
	const ROLE_SOCIAL = "social";
	const ROLE_COMMENT = "comment";
	const ROLE_MODERATOR_ROBOT = "moderator_robot";
	const attachments = 'attachments';
	protected array $attachments = [];
	const created = 'created';
	protected \DateTime|null $created = null;
	protected function getCreated():\DateTime|null{ return $this->created;}
	const email = 'email';
	public string|null $email = null;
	const group = 'group';
	public string|null $group = null;
	const group__admin = 'admin';
	const group__moderator = 'moderator';
	const group__visitor = 'visitor';
	const guid = 'guid';
	public string|null $guid = null;
	const id = 'id';
	protected int|null $id = null;
	protected function getId():int|null{ return $this->id;}
	const name = 'name';
	protected string|null $name = null;
	protected function getName():string|null{ return $this->name;}
	protected function setName(string|null $value){ $this->name = $value;}
	const password = 'password';
	protected string|null $password = null;
	protected function getPassword():string|null{ return $this->password;}
	const updated = 'updated';
	protected \DateTime|null $updated = null;
	protected function getUpdated():\DateTime|null{ return $this->updated;}
}





