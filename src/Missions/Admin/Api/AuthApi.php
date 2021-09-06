<?php namespace Application\Missions\Admin\Api;

use Application\Entity\User;
use Atomino\Bundle\Authenticate\SessionAuthenticator;
use Atomino\Mercury\Responder\Api\Api;
use Atomino\Mercury\Responder\Api\Attributes\Auth;
use Atomino\Mercury\Responder\Api\Attributes\Route;
use Symfony\Component\HttpFoundation\Response;

class AuthApi extends Api{

	public function __construct(private SessionAuthenticator $authenticator){ }

	#[Route( self::POST, '/get' )]
	public function get(){
		$user = User::getAuthenticated();
		if(is_null($user)) return null;
		$roles = $user->getRoles();
		$name = $user->name;
		return [
			"name"=>$name,
			"roles"=>$roles
		];
	}

	#[Route( self::POST, '/login' )]
	#[Auth( false )]
	public function login(){
		$login = $this->data->get('login');
		$password = $this->data->get('password');
		if (!$this->authenticator->login($login, $password)){
			$this->setStatusCode(Response::HTTP_UNAUTHORIZED);
			return false;
		}
		return true;
	}

	#[Route( self::POST, '/logout' )]
	#[Auth]
	public function logout(){
		$this->authenticator->logout($this->getResponse());
	}

}
