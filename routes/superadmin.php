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

Route::get('/superadmin/login', 'SuperAdmin\LoginSuperAdminController@showLoginForm')->name('superadmin.login');
Route::post('/superadmin/login', 'SuperAdmin\LoginSuperAdminController@login');
Route::post('/superadmin/logout', 'SuperAdmin\LoginSuperAdminController@logout')->name('superadmin.logout');

 Route::group(['middleware' => 'revalidate'],function()
{

   Route::get('/superadmin/home', 'SuperAdmin\SuperAdminController@home')->name('superadmin.home');

   Route::get('/superadmin/users', 'SuperAdmin\SuperAdminController@users')->name('superadmin.users');
   Route::get('/superadmin/users_ajax', 'SuperAdmin\SuperAdminController@users_ajax');
   Route::get('/superadmin/{user}/profile', 'SuperAdmin\SuperAdminController@user_profile');
   Route::get('/superadmin/{user}/invoices', 'SuperAdmin\SuperAdminController@user_invoices');
   Route::PATCH('/superadmin/{uuid}/invoice/confirm', 'SuperAdmin\SuperAdminController@invoice_confirm');
   
   Route::get('/superadmin/blog/index', 'SuperAdmin\Blog\SuperAdminBlogController@index')->name('blog.index');
   Route::get('/superadmin/blog/{id}/{slug}', 'SuperAdmin\Blog\SuperAdminBlogController@show')->name('blog.show');
   Route::get('/superadmin/blog/create', 'SuperAdmin\Blog\SuperAdminBlogController@create')->name('blog.create');
   Route::post('/superadmin/blog/store', 'SuperAdmin\Blog\SuperAdminBlogController@store')->name('blog.store');
   Route::get('/superadmin/blog/{id}/{slug}/edit', 'SuperAdmin\Blog\SuperAdminBlogController@edit')->name('blog.edit');
   Route::PATCH('/superadmin/blog/{id}/{slug}/update', 'SuperAdmin\Blog\SuperAdminBlogController@update')->name('blog.update');
   Route::DELETE('/superadmin/blog/{id}/{slug}/delete', 'SuperAdmin\Blog\SuperAdminBlogController@delete')->name('blog.delete');
   Route::PATCH('/superadmin/blog/{id}/{slug}/published', 'SuperAdmin\Blog\SuperAdminBlogController@published')->name('blog.published');

   

});

 