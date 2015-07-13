<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('sportsmed/home', 'BlogController@home');
Route::get('home', 'BlogController@home');
Route::get('/', 'BlogController@home');

// This tells Laravel to run all POST requests through the CSRF filter
Route::when('*', 'csrf', array('post'));


Route::get('sportsmed/addblog', ['middleware' => 'auth', 'uses' => 'BlogController@addBlog']);
Route::get('sportsmed/manageblog', ['middleware' => 'auth', 'uses' => 'BlogController@manageBlogs']);						

Route::get('sportsmed/viewuserblog', ['middleware' => 'auth', 'uses' => 'BlogController@viewUserBlogs']);
Route::post('sportsmed/saveblog', 'BlogController@saveBlog');
Route::post('sportsmed/updateblog', 'BlogController@updateBlog');
Route::post('sportsmed/deleteblog', 'BlogController@deleteBlog');
 

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
