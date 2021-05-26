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
 * @method static \Atomino\Atoms\EntityFinder\_Article search( Filter $filter = null )
 * @property-read \Atomino\Bundle\Attachment\Collection $image
 * @property-read \Atomino\Bundle\Attachment\Collection $head
 * @property-read \Atomino\Bundle\Attachment\Collection $file
 * #[Immutable( 'guid', true )]
 * #[Protect( 'guid', true, false )]
 * #[RequiredField('guid', StringField::class)]
 * @method static \Atomino\Carbon\Database\Finder\Comparison attachments($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison authorId($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison body($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison commentCache($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison guid($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison icon($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison iconColor($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison id($isin = null)
 * @property-read int|null $id
 * @method static \Atomino\Carbon\Database\Finder\Comparison lead($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison metaDescription($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison metaKeywords($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison permalink($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison publishDate($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison relatedIds($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison status($isin = null)
 * @method static \Atomino\Carbon\Database\Finder\Comparison title($isin = null)
 * @property-read \Atomino\Atoms\EntityFinder\_ArticleComment $comments
 * @property-read \Application\Entity\Article[] $related
 */
#[RequiredField('id', \Atomino\Carbon\Field\IntField::class)]
#[Immutable( 'attachments', true )]
#[Protect( 'attachments', false, false )]
#[RequiredField( 'attachments', \Atomino\Carbon\Field\JsonField::class )]
#[RequiredField( 'commentCache', \Atomino\Carbon\Field\JsonField::class )]
#[Field("attachments", \Atomino\Carbon\Field\JsonField::class)]
#[Validator("authorId", \Symfony\Component\Validator\Constraints\NotNull::class)]
#[Validator("authorId", \Symfony\Component\Validator\Constraints\PositiveOrZero::class)]
#[Field("authorId", \Atomino\Carbon\Field\IntField::class)]
#[Validator("body", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>4294967295])]
#[Field("body", \Atomino\Carbon\Field\StringField::class)]
#[Field("commentCache", \Atomino\Carbon\Field\JsonField::class)]
#[Validator("guid", \Symfony\Component\Validator\Constraints\NotNull::class)]
#[Validator("guid", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>36])]
#[Field("guid", \Atomino\Carbon\Field\StringField::class)]
#[Validator("icon", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>255])]
#[Field("icon", \Atomino\Carbon\Field\StringField::class)]
#[Validator("iconColor", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>7])]
#[Field("iconColor", \Atomino\Carbon\Field\StringField::class)]
#[Field("id", \Atomino\Carbon\Field\IntField::class)]
#[Protect("id", true, false)]
#[Immutable("id",false)]
#[Validator("lead", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>2048])]
#[Field("lead", \Atomino\Carbon\Field\StringField::class)]
#[Validator("metaDescription", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>150])]
#[Field("metaDescription", \Atomino\Carbon\Field\StringField::class)]
#[Validator("metaKeywords", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>100])]
#[Field("metaKeywords", \Atomino\Carbon\Field\StringField::class)]
#[Validator("permalink", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>64])]
#[Field("permalink", \Atomino\Carbon\Field\StringField::class)]
#[Field("publishDate", \Atomino\Carbon\Field\DateTimeField::class)]
#[Field("relatedIds", \Atomino\Carbon\Field\JsonField::class)]
#[Validator("status", \Symfony\Component\Validator\Constraints\NotNull::class)]
#[Field("status", \Atomino\Carbon\Field\BoolField::class)]
#[Validator("title", \Symfony\Component\Validator\Constraints\Length::class, ['max'=>255])]
#[Field("title", \Atomino\Carbon\Field\StringField::class)]
abstract class _Article extends Entity implements \Atomino\Bundle\Attachment\AttachmentableInterface, \Atomino\Bundle\Comment\CommentableInterface{
	static null|Model $model = null;
	use \Atomino\Carbon\Plugins\Attachment\AttachmentableTrait;
	protected final function __getImage(){return $this->getAttachmentCollection("image");}
	protected final function __getHead(){return $this->getAttachmentCollection("head");}
	protected final function __getFile(){return $this->getAttachmentCollection("file");}
	use \Atomino\Carbon\Plugins\Guid\GuidTrait;
	use \Atomino\Carbon\Plugins\Comment\CommentableTrait;
	const attachments = 'attachments';
	protected array $attachments = [];
	const authorId = 'authorId';
	public int|null $authorId = null;
	const body = 'body';
	public string|null $body = null;
	const commentCache = 'commentCache';
	public array $commentCache = [];
	const guid = 'guid';
	public string|null $guid = null;
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





