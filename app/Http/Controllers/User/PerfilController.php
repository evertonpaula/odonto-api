<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function get($id) {
        $this->validateAsArray(['user_id' => $id], ['user_id' => 'required|exists:user,id,deleted_at,NULL']);

        $user =  $this->getUserService()->getUser($id);

        return $this->parseResult($user);
    }

    protected function getUserService() {
        return app()->make('user.service');
    }
}
