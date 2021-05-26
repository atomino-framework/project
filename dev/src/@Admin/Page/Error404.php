<?php namespace Application\Admin\Page;

use Atomino\Mercury\Responder\Responder;
use Symfony\Component\HttpFoundation\Response;

class Error404 extends Responder {
	protected function respond(Response $response):Response{
		$response->setStatusCode(Response::HTTP_NOT_FOUND);
		return $response->setContent('Hello 404');
	}
}