<?php

use App\Auth\Controllers\AuthController;
use App\Auth\Controllers\AuthLoginController;
use App\Auth\Controllers\AuthRegisterController;
use App\Auth\Controllers\AuthUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/register',function(Request $request) {
    $auth = new AuthRegisterController();
    return $auth->register($request);
});

Route::get('/confirm/{token}',function(string $token) {
    $auth = new AuthRegisterController();
    return $auth->confirm($token);
});

Route::post('/authenticate',function(Request $request) {
    $auth = new AuthLoginController();
    return $auth->login($request);
});


Route::post('/recovery',function(Request $request) {
    $auth = new AuthUserController();
    return $auth->recoveryPassword($request);
});

Route::post('/verify-email',function(Request $request) {
    $auth = new AuthRegisterController();
    return $auth->sendVerifyEmail($request);
});

Route::put('/recovery/{token}',function(Request $request, string $token) {
    $auth = new AuthUserController();
    return $auth->resetPassword($request, $token);
});

Route::get('/logout',function() {
    $auth = new AuthUserController();
    return $auth->logout();
});

Route::get('/check',function() {
    $auth = new AuthUserController();
    return $auth->check();
})->middleware("auth.cognito");

Route::get('/google-auth',function() {
    $auth = new AuthController();
    return $auth->googleAuthUrl();
});

Route::get('/google-auth/{token}',function(string $token) {
    $auth = new AuthController();
    return $auth->signIn($token);
});