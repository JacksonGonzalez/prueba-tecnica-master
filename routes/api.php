<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/bodegas', 'bodegaController@index');
Route::get('/bodegas/activas', 'bodegaController@bodegasActivas');
Route::post('/bodegas', 'bodegaController@store');
Route::put('/bodegas/update', 'bodegaController@update');
Route::post('/inventarios', 'InventarioController@store');
Route::get('/usuarios', 'UserController@index');
Route::get('/usuarios/activos', 'UserController@usuariosActivos');
Route::get('/productos', 'ProductoController@index');
Route::get('/productos/bodega', 'ProductoController@productoBodega');
Route::put('/productos/update', 'ProductoController@update');
Route::put('/user/update', 'UserController@update');
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});
