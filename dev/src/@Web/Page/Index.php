<?php namespace Application\Web\Page;

use Application\Entity\User;
use Atomino\Molecules\Responder\SmartResponder\SmartResponder;
use Atomino\Molecules\Responder\SmartResponder\Attributes\{Cache, Args, CSS, JS, Init};
use Symfony\Component\HttpFoundation\Response;


#[Init( 'web', 'index.twig' )]
#[Args( title: 'Magic' )]
#[JS( '/~web/index.js' )]
#[CSS( '/~web/index.css' )]
#[Cache( 10 )]

class Index extends SmartResponder{


	protected function prepare(Response $response){
	}
}

