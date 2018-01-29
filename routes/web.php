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


Route::get('/', "TicketController@index")->name("index");
Route::post("/", "TicketController@login")->name("login");



Route::get("/admin/login", "TicketController@adminLogin")->name("admin_login");


Route::get("/user/register", "TicketController@showRegisterPage");
Route::post("/user/register", "TicketController@create")->name("create_user");

Route::group(['middleware' => 'auth'], function() {

	Route::get("/user", "TicketController@user")->name("user_page");
	Route::get("/admin/result", "TicketController@result");
	Route::get("/admin","TicketController@admin");
});



Route::get("/layouts", function() {
	return view("layouts.admin_master");
});


Route::get("/tasks", "TaskController@taskindex");


Route::get("/tasks/completed", "TaskController@completed");


Route::get("/tasks/not_completed", "TaskController@notcompleted");


Route::get("/tasks/{id?}", "TaskController@showtask")->name("tasks");

