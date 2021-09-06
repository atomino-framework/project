<?php namespace Application\Missions\Admin\Page;

use Application\Services\ActualEventService;
use Atomino\Mercury\Responder\Smart\SmartResponder;
use Atomino\Mercury\Responder\Smart\Attributes\{Cache, Args, CSS, JS, Init};
use Symfony\Component\HttpFoundation\Response;

#[Init( 'gold', 'index.twig', "mobile.twig")]
#[Args( title: 'Atomino Gold' )]
#[JS('/~gold/index.js')]
#[CSS('/~gold/index.css')]
#[Cache( 0 )]
class Index extends SmartResponder{
	public array $users;
	public function __construct() { }

	protected function prepare(Response $response){}

}
