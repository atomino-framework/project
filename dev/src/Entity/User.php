<?php namespace Application\Entity;

use Atomino\Atoms\Entity\_User;
use Atomino\Database\Finder\Filter;
use Atomino\Entity\Attributes\BelongsTo;
use Atomino\Entity\Attributes\HasMany;
use Atomino\Entity\Attributes\Modelify;
use Atomino\Entity\Attributes\Protect;
use Atomino\Entity\Attributes\Validator;
use Atomino\Entity\EntityInterface;
use Atomino\Molecules\EntityPlugin\Attachmentable\Attachmentable;
use Atomino\Molecules\EntityPlugin\Attachmentable\Attributes\AttachmentCollection;
use Atomino\Molecules\EntityPlugin\Authenticable\Authenticable;
use Atomino\Molecules\EntityPlugin\Authorizable\Authorizable;
use Atomino\Molecules\EntityPlugin\Created\Created;
use Atomino\Molecules\EntityPlugin\Guid\Guid;
use Atomino\Molecules\EntityPlugin\Updated\Updated;
use Atomino\Molecules\Module\Comment\CommenterInterface;

#[Modelify( \Application\Database\DefaultConnection::class, 'user', true )]
#[Validator( 'email', \Symfony\Component\Validator\Constraints\Email::class )]
#[Protect( 'name', true, true )]
#[Guid()]
#[Created()]
#[Updated()]
#[Attachmentable()]
#[AttachmentCollection( field: 'avatar', maxCount: 1, maxSize: 512 * 1024, mimetype: "/image\/.*/" )]
#[Authenticable( 'email' )]
#[Authorizable( 'group', ['edit', 'moderate', 'social', 'comment', 'moderator_robot'] )]
class User extends _User implements CommenterInterface {

	const GROUPS = [
		User::group__visitor   => [self::ROLE_SOCIAL],
		User::group__moderator => [self::ROLE_SOCIAL, self::ROLE_MODERATE],
		User::group__admin     => [self::ROLE_SOCIAL, self::ROLE_MODERATE, self::ROLE_EDIT],
	];

	public function canAddComment(): bool { return $this->hasRole(self::ROLE_SOCIAL); }
	public function canModerateComment(): bool { return $this->hasRole(self::ROLE_MODERATE); }
	public function canCommentAsBot(): bool { return $this->hasRole(self::ROLE_MODERATE); }
}

