<?php namespace Application\Missions\Admin\Api;

use Application\Entity\User;
use Atomino\Mercury\Responder\Api\Api;
use Atomino\Mercury\Responder\Api\Attributes\Auth;
use Atomino\Mercury\Responder\Api\Attributes\Route;

#[Auth(User::ROLE_ADMIN)]
class DashboardApi extends Api {
	#[Route("GET", "/")]
	public function get(){
		return [
			"userCount"=>User::search()->count()
		];
	}
}
