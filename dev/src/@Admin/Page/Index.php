<?php namespace Application\Admin\Page;

use Atomino\RequestPipeline\Responder\Smart\SmartResponder;
use Atomino\RequestPipeline\Responder\Smart\Attributes\{Cache, Args, CSS, JS, Init};
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

