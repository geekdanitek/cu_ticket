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
Route::get('/welcome', 'TaskController@welcome');

Route::get('/', "TicketController@index")->name("index");
Route::post("/", "TicketController@loginSubmit")->name("login");

Route::get("/admin/tickets/{id}/update", "TicketController@update")->name("update_status");

Route::get("/admin/tickets/{status?}", "TicketController@tickets")->name("tickets");

Route::get("/user/logout", "TicketController@logout")->name("logout");

Route::post("/admin/addQueues", "TicketController@createQueues")->name("create_queues");
Route::post("/admin/create", "TicketController@createAdmin")->name("create_admin");
// Route::get("/admin/tickets", "TicketController@tickets")->name("total_tickets");

Route::get("/admin", "TicketController@admin")->name("admin_page");

Route::get("/admin/login", "TicketController@adminLogin")->name("admin_login");

Route::post("/admin/login", "TicketController@adminLoginSubmit");


Route::get("/user", "TicketController@user")->name("user_page");

Route::get("/user/register", "TicketController@showRegisterPage")->name("register");

Route::post("/user/register", "TicketController@create")->name("create_user");


Route::post("/user/ticket", "TicketController@createTicket")->name("create_ticket");
//route user
Route::get("/user/reset", "TicketController@reset")->name("reset");

Route::post("/user/reset", "TicketController@resetAction")->name("reset_user");

Route::get("/user/reset/set/{rand}", "TicketController@resetPasswordView")->name("reset_page");

Route::post("/user/reset/set/", "TicketController@resetPassword")->name("reset_action");
//route user end

//route admin
Route::get("/admin/reset", "TicketController@resetAdmin")->name("reset_admin");

Route::post("/admin/reset", "TicketController@resetActionAdmin")->name("reset_admin_post");

Route::get("/admin/reset/set/{rand}", "TicketController@resetPasswordViewAdmin")->name("reset_page_admin");

Route::post("/admin/reset/set/", "TicketController@resetPasswordAdmin")->name("reset_action_admin");
//route admin end
Route::get("/layouts", function () {
    return view("layouts.admin_master");
});


Route::get("/tasks", "TaskController@taskindex");


Route::get("/tasks/completed", "TaskController@completed");


Route::get("/tasks/not_completed", "TaskController@notcompleted");


Route::get("/tasks/{id?}", "TaskController@showtask")->name("tasks");
Route::get("/uncleYomi/{id?}", "TicketController@uncleYomi")->name("uncleYomi");

Route::post("//uncleYomi", "TicketController@uncleYomiPost")->name("post2");