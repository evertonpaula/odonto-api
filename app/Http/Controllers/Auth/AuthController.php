<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Epsoftware\Auth\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function login() {

        $this->validate( $this->request, [
            'email'  => 'required|email',
            'password'  => 'required|string'
        ]);

        $auth = Auth::authentication( $this->request->only('email'), $this->request->only('password') );

        if ( $auth && Auth::getUser()->activated ) {

            if ( Auth::getUser()->locked ) return $this->failResponse('Usuário bloqueado.');

            return $this->parseResult(['token' => Auth::getToken(), 'user'  => Auth::getUser()], 'Login efeutado com sucesso.');
        }

        return $this->failResponse('Acesso não autorizado');
    }

    public function singUp() {

        $this->validate($this->request, [
            'name'  => 'required|string',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|confirmed|string|min:5'
        ]);

        $password = Hash::make( $this->request->get('password') );
        $args = array_merge(
            $this->request->except(['password','password_confirmation']),
            ['password' => $password]
        );

        $user = $this->getUserService()->createUser($args);

        if ( ! $user ) $this->failResponse('Falha ao criar usuário');

        return $this->parseResult($user, 'Usuário criado. Acesse seu e-mail e ative sua conta.');
    }

    public function forgetPassword() {
        $this->validate($this->request, [
            'email' => 'required|email|exists:user,email,deleted_at,NULL'
        ]);

        $recover = $this->getUserService()->forgetPassword($this->request->all());

        if ( $recover ) return $this->parseResult([], 'Acesse seu email e siga as instruções para recuperação de conta.');

        return $this->failResponse('Oops, alguma coisa errada ocorreu.');
    }

    public function activatedAccount() {
        $this->validate($this->request, [
            'token' => 'required|exists:user,uuid,deleted_at,NULL'
        ]);

        $activated = $this->getUserService()->activatedAccount($this->request->all());

        if ( $activated ) return $this->parseResult($activated, 'Sua conta foi ativada com sucesso, aguarde o administrador desbloque-la para acesso.');

        return $this->failResponse('Oops, alguma coisa errada ocorreu.');
    }

    public function getUserFromRecoverToken($token) {
        $this->validateAsArray([ 'token' =>$token ], [
            'token' => 'required|exists:recover_password,token'
        ]);

        $user = $this->getUserService()->getUserFromRecoverToken($token);

        if ( $user ) return $this->parseResult($user, 'Token válido para recuperação de senha.');

        return $this->failResponse('Oops, não foi possível recuperar sua conta.');

    }

    public function recoverPassword() {
        $this->validate($this->request, [
            'email' => 'required|email|exists:user,email',
            'password' => 'required|confirmed|string|min:5',
            'token' => 'required|exists:recover_password,token'
        ]);

        $password = Hash::make( $this->request->get('password') );

        $args = array_merge(
            $this->request->except(['password','password_confirmation']),
            ['password' => $password]
        );

        $recovered = $this->getUserService()->recoverPassword($args);

        if ( $recovered ) return $this->parseResult($recovered, 'Sua senha foi redefinada, por favor acesse a área de login e acesse sua conta.');

        return $this->failResponse('Oops, não foi possível recuperar sua conta.');
    }

    protected function getUserService() {
        return app()->make('user.service');
    }
}
