<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/danmu', function() {
    return view('danmu');
});

Route::get('/auth/password', function (\Illuminate\Http\Request $request){
    $http = new \GuzzleHttp\Client();

    $response = $http->post('http://luochat.test/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => '2',
            'client_secret' => '7FjSZD2u5kj1bVxBFoJE9e7ahw2eVAo68EUACjIV',
            'username' => '1185079673@qq.com',
            'password' => '12345678',
            'scope' => '',
        ],
    ]);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
