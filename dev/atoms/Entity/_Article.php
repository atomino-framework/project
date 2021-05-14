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
 * @method static \Atomino\Atoms\EntityFinder\_Article search( Filter $filter = null )
 * @property-read \Atomino\Molecules\Module\Attachment\Collection $image
 * @property-read \Atomino\Molecules\Module\Attachment\Collection $head
 * @property-read \Atomino\Molecules\Module\Attachment\Collection $file
 * @method static \Atomino\Database\Finder\Comparison attachments($isin = null)
 * @method static \Atomino\Database\Finder\Comparison authorId($isin = null)
 * @method static \Atomino\Database\Finder\Comparison body($isin = null)
 * @method static \Atomino\Database\Finder\Comparison guid($isin = null)
 * @property-read string|null $guid
 * @method static \Atomino\Database\Finder\Comparison icon($isin = null)
 * @method static \Atomino\Database\Finder\Comparison iconColor($isin = null)
 * @method static \Atomino\Database\Finder\Comparison id($isin = null)
 * @property-read int|null $id
 * @method static \Atomino\Database\Finder\Comparison lead($isin = null)
 * @method static \Atomino\Database\Finder\Comparison metaDescription($isin = null)
 * @method static \Atomino\Database\Finder\Comparison metaKeywords($isin = null)
 * @method static \Atomino\Database\Finder\Comparison permalink($isin = null)
 * @method static \Atomino\Database\Finder\Comparison publishDate($isin = null)
 * @method static \Atomino\Database\Finder\Comparison relatedIds($isin = null)
 * @method static \Atomino\Database\Finder\Comparison status($isin = null)
 * @method static \Atomino\Database\Finder\Comparison title($isin = null)
 * @property-read \Application\Entity\Article[] $related
 */
#[RequiredField('id', \Atomino\Entity\Field\IntField::class)]
#[Immutable( 'attachments', true )]
#[Protect( 'attachments', false, false )]
#[RequiredField( 'attachments', \Atomino\Entity\Field\JsonField::class )]
#[Immutable( 'guid', true )]
#[Protect( 'guid', true, false )]
#[RequiredField('guid', \Atomino\Entity\Field\StringField::class)]
#[Field("attachments", \Atomino\Entity\Field\JsonField::class)]
#[Validator("authorId", \Symfony\Component\Validator\Constraints\NotNull::class)]
#[Validator("authorId", \Symfony\Component\Validator\Constraints\PositiveOrZero::class)]
#[Field("authorId", \Atomino\Entity\Field\IntField::class)]
#[Validator("body", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>4294967295])]
#[Field("body", \Atomino\Entity\Field\StringField::class)]
#[Validator("guid", \Symfony\Component\Validator\Constraints\NotNull::class)]
#[Validator("guid", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>36])]
#[Field("guid", \Atomino\Entity\Field\StringField::class)]
#[Validator("icon", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>255])]
#[Field("icon", \Atomino\Entity\Field\StringField::class)]
#[Validator("iconColor", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>7])]
#[Field("iconColor", \Atomino\Entity\Field\StringField::class)]
#[Field("id", \Atomino\Entity\Field\IntField::class)]
#[Protect("id", true, false)]
#[Immutable("id",false)]
#[Validator("lead", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>2048])]
#[Field("lead", \Atomino\Entity\Field\StringField::class)]
#[Validator("metaDescription", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>150])]
#[Field("metaDescription", \Atomino\Entity\Field\StringField::class)]
#[Validator("metaKeywords", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>100])]
#[Field("metaKeywords", \Atomino\Entity\Field\StringField::class)]
#[Validator("permalink", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>64])]
#[Field("permalink", \Atomino\Entity\Field\StringField::class)]
#[Field("publishDate", \Atomino\Entity\Field\DateTimeField::class)]
#[Field("relatedIds", \Atomino\Entity\Field\JsonField::class)]
#[Validator("status", \Symfony\Component\Validator\Constraints\NotNull::class)]
#[Field("status", \Atomino\Entity\Field\BoolField::class)]
#[Validator("title", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>255])]
#[Field("title", \Atomino\Entity\Field\StringField::class)]
abstract class _Article extends Entity implements \Atomino\Molecules\Module\Attachment\AttachmentableInterface{
	static null|Model $model = null;
	use \Atomino\Molecules\EntityPlugin\Attachmentable\AttachmentableTrait;
	protected final function __getImage(){return $this->getAttachmentCollection("image");}
	protected final function __getHead(){return $this->getAttachmentCollection("head");}
	protected final function __getFile(){return $this->getAttachmentCollection("file");}
	use \Atomino\Molecules\EntityPlugin\Guid\GuidTrait;
	const attachments = 'attachments';
	protected array $attachments = [];
	const authorId = 'authorId';
	public int|null $authorId = null;
	const body = 'body';
	public string|null $body = null;
	const guid = 'guid';
	protected string|null $guid = null;
	protected function getGuid():string|null{ return $this->guid;}
	const icon = 'icon';
	public string|null $icon = null;
	const iconColor = 'iconColor';
	public string|null $iconColor = null;
	const id = 'id';
	protected int|null $id = null;
	protected function getId():int|null{ return $this->id;}
	const lead = 'lead';
	public string|null $lead = null;
	const metaDescription = 'metaDescription';
	public string|null $metaDescription = null;
	const metaKeywords = 'metaKeywords';
	public string|null $metaKeywords = null;
	const permalink = 'permalink';
	public string|null $permalink = null;
	const publishDate = 'publishDate';
	public \DateTime|null $publishDate = null;
	const relatedIds = 'relatedIds';
	public array $relatedIds = [];
	const status = 'status';
	public bool|null $status = null;
	const title = 'title';
	public string|null $title = null;
}





