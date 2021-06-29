<?php namespace Application\Missions\Api\Api;

use Application\Entity\User;
use Atomino\Mercury\Responder\Api\Api;
use Atomino\Mercury\Responder\Api\Attributes\Route;
use Symfony\Component\HttpFoundation\Response;

class UserApi extends Api {

	#[Route(self::GET, '/:id([0-9]+)')]
	public function get(int $id) {
		if (!($user = User::pick($id)->export())) $this->setStatusCode(Response::HTTP_NOT_FOUND);
		return $user;
	}


}
