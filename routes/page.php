<?php
//use Mailgun;
/*
|--------------------------------------------------------------------------
| page Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@welcome');
Route::get('/features', 'HomeController@features');
Route::get('/pricing', 'HomeController@pricing');
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');
Route::get('/privacy_policy', 'HomeController@privacy_policy');
Route::get('/terms_conditions', 'HomeController@terms_conditions');
Route::post('/contact/post', 'HomeController@contact_post');
Route::post('/subscription/email', 'HomeController@subscription_post');

Route::get('/staff/city_state/{id}', 'HomeController@city_state_ajax');

// Route::get('/testingmailgun',function(){

//   $data = [
// 'customer' => 'John Smith',
// 'url' => 'http://laravel.com'
// ];

// \Mailgun::send('emails.welcome', $data, function ($message) {
// $message->to('vipinoo7@yahoo.in', 'John Smith')->subject('Welcome!');
// });
// });
