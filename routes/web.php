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





Route::get('/', 'IndexController@index')->name('mobile.index');
Route::get('/menu', 'MenuController@menu')->name('mobile.menu');
Route::post('/qr_scan', 'QRController@qrScan')->name('QRScan');


Auth::routes();

Route::post('/data', 'SocketPostController@socketPost')->name('socketPost')->middleware('auth:api');




Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
