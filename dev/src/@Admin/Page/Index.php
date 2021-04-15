<?php namespace Application\Admin\Page;

use Application\Entity\User;
use Atomino\Molecules\Responder\SmartResponder\SmartResponder;
use Atomino\Molecules\Responder\SmartResponder\Attributes\{Cache, Args, CSS, JS, Init};
use Symfony\Component\HttpFoundation\Response;


#[Init( 'admin', 'index.twig' )]
#[Args( title: 'Magic' )]
#[JS( '/~admin/index.js' )]
#[CSS( '/~admin/index.css' )]
#[Cache( 10 )]

class Index extends SmartResponder{


	protected function prepare(Response $response){
	}
}

