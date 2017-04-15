<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{

	/**
	* A list of the exception types that should not be reported.
	* @var array
	*/
	protected $dontReport = [
		HttpException::class,
		HttpResponseException::class,
		MethodNotAllowedHttpException::class
	];

	/**
	* Report or log an exception.
	* This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	* @param  \Exception  $e
	* @return void
	*/
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	* Render an exception into an HTTP response.
	* @param  \Illuminate\Http\Request  $request
	* @param  \Exception  $e
	* @return \Illuminate\Http\Response
	*/
	public function render($request, Exception $e)
	{
		if ($e instanceof HttpResponseException) {
			return $e->getResponse();
		}

		if ( env('APP_ENV') != 'production' ) {
            return parent::render($request, $e);
        }

		if ( $e instanceof HttpExceptionInterface ||
			 $e instanceof MethodNotAllowedHttpException ||
			 $e instanceof NotFoundHttpException )
		{
			return $this->response( 'Method Route Not found.');
		}

		return $this->response($e->getMessage(), $e->getCode());
	}

	protected function response($message, $code = 422) {
		return new JsonResponse([
			'data'=> null,
			'code' => $code ?:422,
			'message' => $message
		], $code ?: 422 );
	}
}
