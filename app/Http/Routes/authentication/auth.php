<?php

$app->post('sing-up', 'Auth\AuthController@singUp');
$app->post('login', 'Auth\AuthController@login');
$app->post('forget-password', 'Auth\AuthController@forgetPassword');
$app->patch('activated', 'Auth\AuthController@activatedAccount');
$app->get('recover/{token}', 'Auth\AuthController@getUserFromRecoverToken');
$app->put('recover', 'Auth\AuthController@recoverPassword');
