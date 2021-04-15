<?php namespace Application\Api\Api;

use Application\Entity\User;
use Atomino\Molecules\Module\Authenticator\ApiAuthenticator;
use Atomino\Molecules\Responder\Api\Api;
use Atomino\Molecules\Responder\Api\Attributes\Auth;
use Atomino\Molecules\Responder\Api\Attributes\Route;
use Symfony\Component\HttpFoundation\Response;

class UserApi extends Api{

	public function __construct(private ApiAuthenticator $authenticator){ }

	#[Route( self::POST, '/:id([0-9]+)/password' )]
	public function post_password(int $id){
		$password = $this->getDataBag()->get('password');
		$user = User::pick($id);
		if($user){
			$user->setPassword($password);
			$user->save();
		}else{
			$this->setStatusCode(Response::HTTP_NOT_FOUND);
		}
	}

	#[Route( self::POST, '/login' )]
	public function post_login(){
		$login = $this->getDataBag()->get('login');
		$password = $this->getDataBag()->get('password');
		if(!($authToken = $this->authenticator->login($login, $password))) $this->setStatusCode(Response::HTTP_UNAUTHORIZED);
		return ['auth-token' => $authToken];
	}

	#[Route( self::POST, '/refresh-auth-token' )]
	public function post_refreshAuthToken(){
		$refreshToken = $this->getDataBag()->get('refresh-token');
		if(!($authToken = $this->authenticator->getAuthToken($refreshToken))) $this->setStatusCode(Response::HTTP_UNAUTHORIZED);
		return ['auth-token' => $authToken];
	}

	#[Route( self::GET, '/refresh-token' )]
	#[Auth(User::ROLE_SOCIAL)]
	public function getRefreshToken(): array{
		return ['refresh-token' => $this->authenticator->getRefreshToken()];
	}

	#[Route( self::GET, Route::Barefoot )]
	public function get(int $id): mixed{
		if(!($user = User::pick($id)->export())) $this->setStatusCode(Response::HTTP_NOT_FOUND);
		return $user;
	}

}
