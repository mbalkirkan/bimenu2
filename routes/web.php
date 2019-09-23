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
Route::get('test-broadcast', function(){
    broadcast(new \App\Events\ExampleEvent);
});

Route::get('test-broadcasts', function(){
    broadcast(new \App\Events\PrivateEvent(auth()->user()));
});
Route::post('/notification', 'SocketPostController@sendnotification')->name('sendnotification')->middleware('auth:api');
Route::post('/addprice', 'SocketPostController@socketAddPrice')->name('AddPrice')->middleware('auth:api');
Route::post('/gettprice', 'SocketPostController@socketGettPrice')->name('Getprice')->middleware('auth:api');
Route::post('/pushprice', 'SocketPostController@socketPushPrice')->name('PushPrice')->middleware('auth:api');


Route::group(['middleware' => 'checksession'], function () {
    Route::get('/', 'IndexController@index')->name('mobile.index');
    Route::post('/qr_scan', 'QRController@qrScan')->name('QRScan');
    Route::get('/qr_generator', 'QRController@qrGenerator')->name('QRGenerator');
    Route::get('/menu', 'MenuController@menu')->name('mobile.menu');
    Route::get('/logout', 'IndexController@session_flush')->name('session.flush');

});

Route::group(['middleware' => 'checkonsession'], function () {
Route::get('/session', 'IndexController@session')->name('session.view');
Route::post('/session', 'IndexController@session_save')->name('session.save');
});
Auth::routes();




Route::post('/data', 'SocketPostController@socketPost')->name('socketPost')->middleware('auth:api');




Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
