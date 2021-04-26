<?php namespace Application\Web\Page;

use Atomino\RequestPipeline\Responder\Smart\SmartResponder;
use Atomino\RequestPipeline\Responder\Smart\Attributes\{Cache, Args, CSS, JS, Init};
use Symfony\Component\HttpFoundation\Response;


#[Init( 'web', 'index.twig' )]
#[Args( title: 'Magic' )]
#[JS( '/~web/index.js' )]
#[CSS( '/~web/index.css' )]
#[Cache( 10 )]

class Index extends SmartResponder{
	protected function prepare(Response $response){}
}

