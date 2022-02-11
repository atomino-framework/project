<?php namespace Application\Entity;

use Application\Atoms\Entity\_User;
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

#[Modelify(\Application\Database\DefaultConnection::class, 'user', true)]
#[Validator('email', \Symfony\Component\Validator\Constraints\Email::class)]
#[Protect('name', true, true)]
#[Guid()]
#[Created()]
#[Updated()]
#[Attachmentable()]
#[AttachmentCollection(field: 'avatar', maxCount: 1, maxSize: 1024 * 1024, mimetype: "/image\/.*/")]
#[Authenticable('email')]
#[Authorizable('group', ['admin', 'visitor'])]
class User extends _User {
	const GROUPS = [
		self::group__admin   => [self::ROLE_ADMIN, self::ROLE_VISITOR],
		self::group__visitor => [self::ROLE_VISITOR],
	];
}
