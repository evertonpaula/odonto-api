<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use Validator;


class Controller extends BaseController
{
    protected $response = [
      'message' => 'ERR',
      'data'  => null,
      'code' => 422
    ];

    public function validate( Request $request, array $rules, array $messages = [], array $customAttributes = [] ) {
        $validator = $this->getValidationFactory()->make( $request->all(), $rules, $messages, $customAttributes );
        if( $validator->fails() ) {
            $this->response['message'] = Lang::get('validation.default_msg');
            $error_messages = array_values( $validator->errors()->getMessages() );
            if( count($error_messages) ) {
                $this->response['message'] = $error_messages[0][0];
            }
            $jsonResponse = new JsonResponse( $this->response, 422 );
            throw new HttpResponseException( $jsonResponse );
        }
    }

    public function validateAsArray(array $data, array $rules, array $messages = []) {
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $this->response['message'] = $validator->errors()->first();
            $jsonResponse = new JsonResponse( $this->response, 422 );
            throw new HttpResponseException( $jsonResponse );
        }
    }

    public function parseResult( $data = null, $message = '', $code = 200) {
        $this->response['message'] = $message;
        $this->response['data'] = $data;
        $this->response['code'] = $code;
        return new JsonResponse( $this->response, $code );
    }

    public function failResponse($message, $code = 422) {
        $this->response['message'] = $message;
        $this->response['code'] = $code;
        return new JsonResponse($this->response, $code);
	}
}
