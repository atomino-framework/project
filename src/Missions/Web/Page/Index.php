<?php namespace Application\Missions\Web\Page;

use Atomino\Mercury\Responder\Smart\SmartResponder;
use Atomino\Mercury\Responder\Smart\Attributes\{Cache, Args, CSS, JS, Init};
use Symfony\Component\HttpFoundation\Response;

#[Init( 'web', 'index.twig' )]
#[Args( title: 'Atomino' )]
#[Cache( 10 )]
class Index extends SmartResponder{
	public array $users;
	protected function prepare(Response $response){}
}
