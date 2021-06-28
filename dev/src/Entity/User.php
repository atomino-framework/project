<?php namespace Application\Entity;

use Atomino\Atoms\Entity\_User;
use Atomino\Atoms\Entity\User\Groups;
use Atomino\Bundle\Comment\CommenterInterface;
use Atomino\Carbon\Attributes\Modelify;
use Atomino\Carbon\Attributes\Protect;
use Atomino\Carbon\Attributes\Validator;
use Atomino\Carbon\Plugins\Attachment\Attachmentable;
use Atomino\Carbon\Plugins\Attachment\AttachmentCollection;
use Atomino\Carbon\Plugins\Authenticate\Authenticable;
use Atomino\Carbon\Plugins\Authorize\Authorizable;
use Atomino\Carbon\Plugins\Created\Created;
use Atomino\Carbon\Plugins\Guid\Guid;
use Atomino\Carbon\Plugins\Updated\Updated;
use Symfony\Component\HttpFoundation\Request;
use function Atomino\path;

#[Modelify(\Application\Database\DefaultConnection::class, 'user', true)]
#[Validator('email', \Symfony\Component\Validator\Constraints\Email::class)]
#[Protect('name', true, true)]
#[Guid()]
#[Created()]
#[Updated()]
#[Attachmentable()]
#[AttachmentCollection(field: 'avatar', maxCount: 1, maxSize: 512 * 1024, mimetype: "/image\/.*/")]
#[Authenticable('email')]
#[Authorizable('group', ['edit', 'moderate', 'social', 'comment', 'moderator_robot'])]
class User extends _User implements CommenterInterface {


	const GROUPS = [
		self::group__visitor   => [self::ROLE_SOCIAL],
		self::group__moderator => [self::ROLE_SOCIAL, self::ROLE_MODERATE],
		self::group__admin     => [self::ROLE_SOCIAL, self::ROLE_MODERATE, self::ROLE_EDIT],
	];

	public function canAddComment(): bool { return $this->hasRole(self::ROLE_SOCIAL); }
	public function canModerateComment(): bool { return $this->hasRole(self::ROLE_MODERATE); }
	public function canCommentAsBot(): bool { return $this->hasRole(self::ROLE_MODERATE); }
}
