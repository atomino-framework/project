<?php namespace Application\Missions\Web\Page;

use Atomino\Mercury\Responder\Smart\SmartResponder;
use Atomino\Mercury\Responder\Smart\Attributes\{Cache, Args, CSS, JS, Init};
use Symfony\Component\HttpFoundation\Response;
use function Atomino\debug;

#[Init( 'web', 'index.twig', 'mobile.twig' )]
#[Args( title: 'Atomino' )]
#[Cache( 0 )]
class Index extends SmartResponder{
	public array $users;
	protected function prepare(Response $response){	}
}

