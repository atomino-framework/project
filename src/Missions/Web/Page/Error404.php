<?php namespace Application\Missions\Web\Page;

use Atomino\Mercury\Responder\Responder;
use Symfony\Component\HttpFoundation\Response;

class Error404 extends Responder {

	protected function respond(Response $response):Response{
		$response->setStatusCode(Response::HTTP_NOT_FOUND);
		return $response->setContent('Error 404');
	}
}