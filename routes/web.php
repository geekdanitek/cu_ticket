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
Route::post("/", "TicketController@loginSubmit")->name("login");

Route::get("/admin/tickets/{id}/update", "TicketController@update")->name("update_status");

Route::get("/admin/tickets/{status?}", "TicketController@tickets")->name("tickets");

Route::get("/user/logout", "TicketController@logoutUser")->name("logout_user");


// Route::get("/admin/tickets", "TicketController@tickets")->name("total_tickets");

Route::get("/admin", "TicketController@admin")->name("admin_page");
Route::get("/admin/login", "TicketController@adminLogin")->name("admin_login");

Route::get("/user", "TicketController@user")->name("user_page");
Route::get("/user/register", "TicketController@showRegisterPage")->name("register");
Route::post("/user/register", "TicketController@create")->name("create_user");

Route::post("/user/ticket", "TicketController@createTicket")->name("create_ticket");

Route::get("/layouts", function () {
    return view("layouts.admin_master");
});


Route::get("/tasks", "TaskController@taskindex");


Route::get("/tasks/completed", "TaskController@completed");


Route::get("/tasks/not_completed", "TaskController@notcompleted");


Route::get("/tasks/{id?}", "TaskController@showtask")->name("tasks");
