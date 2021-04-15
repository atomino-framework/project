<?php namespace Application\Web\Api;

use Application\Entity\User;
use Atomino\Molecules\Module\Authenticator\SessionAuthenticator;
use Atomino\Molecules\Responder\Api\Api;
use Atomino\Molecules\Responder\Api\Attributes\Auth;
use Atomino\Molecules\Responder\Api\Attributes\Route;
use Symfony\Component\HttpFoundation\Response;

class AuthApi extends Api{

	public function __construct(private SessionAuthenticator $authenticator){ }

	#[Route( self::GET, '/' )]
	public function get(){
		return User::getAuthenticated() ?? false;
	}

	#[Route( self::POST, '/login' )]
	#[Auth( false )]
	public function login(){
		$login = $this->getDataBag()->get('login');
		$password = $this->getDataBag()->get('password');
		if (!$this->authenticator->login($login, $password)){
			$this->getResponse()->setStatusCode(Response::HTTP_UNAUTHORIZED);
			return false;
		}
		return true;
	}

	#[Route( self::GET, '/request-autologin' )]
	#[Auth]
	public function get_requestAutologin(){
		$this->authenticator->deployRefreshToken($this->getResponse());
	}

	#[Route( self::GET, '/logout' )]
	#[Auth]
	public function logout(){
		$this->authenticator->logout($this->getResponse());
	}

}
