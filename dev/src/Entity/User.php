<?php namespace Application\Entity;

use Atomino\Atoms\Entity\_User;
use Atomino\Entity\Attributes\BelongsTo;
use Atomino\Entity\Attributes\HasMany;
use Atomino\Entity\Attributes\Modelify;
use Atomino\Entity\Attributes\Protect;
use Atomino\Entity\Attributes\Validator;
use Atomino\Molecules\EntityPlugin\Attachmentable\Attachmentable;
use Atomino\Molecules\EntityPlugin\Attachmentable\Attributes\AttachmentCollection;
use Atomino\Molecules\EntityPlugin\Authenticable\Authenticable;
use Atomino\Molecules\EntityPlugin\Authorizable\Authorizable;
use Atomino\Molecules\EntityPlugin\Created\Created;
use Atomino\Molecules\EntityPlugin\Guid\Guid;

#[Modelify( \Application\Database\DefaultConnection::class, 'user', true )]
#[Validator( 'email', \Symfony\Component\Validator\Constraints\Email::class )]
#[Protect( 'name', true, true )]
#[Guid()]
#[Created()]
#[Attachmentable()]
#[AttachmentCollection( field: 'avatar', maxCount: 1, maxSize: 512 * 1024, mimetype: "/image\/.*/" )]
#[Authenticable( 'email' )]
#[Authorizable( 'group', ['edit', 'moderate', 'social'] )]
class User extends _User{

	const GROUPS = [
		User::group__visitor   => [self::ROLE_SOCIAL],
		User::group__moderator => [self::ROLE_SOCIAL, self::ROLE_MODERATE],
		User::group__admin     => [self::ROLE_SOCIAL, self::ROLE_MODERATE, self::ROLE_EDIT],
	];

}

