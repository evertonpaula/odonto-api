<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Open routes to login, logout, recover password and forget password //
\App\Helpers\Utils::requireRoute('authentication.auth');

// Authorization routes //
$app->group(['middleware' => 'jwt-auth'], function ($app) {
    // User Perfil //
    \App\Helpers\Utils::requireRoute('user.perfil');
    \App\Helpers\Utils::requireRoute('file.upload');
});
