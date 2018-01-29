<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Queue;
use App\User;
use Auth;

class TicketController extends Controller
{
    //
    public function index () {

    	return view("cu_ticket_index");
    }

    public function user() {
    	$passed = ["name" => "User"];
    	// dd($passed);
    	return view("cu_ticket_users", $passed);
    }

    public function adminLogin() {
    	
    	return view("cu_ticket_admin_login");
    }

    public function admin() {
    	$passed['tickets_table'] = Ticket::get();
    	$passed['queues'] = Queue::get();

        $passed['total_amount'] = Ticket::count();
        $passed['open_amount'] = Ticket::where('status', 'new')->count();
        $passed['pending_amount'] = Ticket::where('status', 'inprogress')->count();
        $passed['rejected_amount'] = Ticket::where('status', 'rejected')->count();
        $passed['finished_amount'] = Ticket::where('status', 'finished')->count();
        $passed['name'] = "Admin";
        
    	return view("cu_ticket_admin", $passed);
    }
    public function result() {
        $passed = ["name" => "Admin"];
    	return view("cu_ticket_result", $passed);
    }

    public function showRegisterPage() {
        
        // $name = $request->get("email");
        // $all = $request->all();

        // dd($name, $all);
        $passed['name'] = "Admin";

        return view("cu_ticket_users_registration", $passed);
    }

    public function create(Request $request) {
    	
    	$user = new User;
    	$user->name = $request->get("name");
    	$user->email = $request->get("email");
    	$user->password = bcrypt($request->get("password"));
    	$user->location = $request->get("location");
    	$user->type = $request->get("type");
    	if ($user->matric_no == null) {
    			$user->matric_no = "";
    		}else {
    			$user->matric_no = $request->get("matric_no");
    		}
    	if ($user->staff_id == null) {
    		$user->staff_id =  "";
    	}else {
    			$user->staff_id = $request->get("staff_id");
    	}
    	//dd($user->matric_no);
		$user_state = $user->save();
			if ($user_state) {

					return redirect()->route("user_page");
			}
		
    }

    public function login(Request $request) {
    	$email = $request->get("email");
    	$password = $request->get("password");
    	// $email_check = User::where(["email" => $email, "passed"])->count();
		$user = Auth::attempt(['email' => $email, 'password' => $password]);
		// $u = User::where("email", $email)->first();

		// Auth::login($u);

    	if($user) {
    		// dd(\Auth::user());
    		return redirect()->route("user_page");
    	} else {

    		return redirect()->route("index")->with(["login_error"=>"Username or password invalid"]);
    	}



    }

    public function createTicket(Request $request) {

    	$ticket = new Ticket;
    	$ticket->subject = $request->get("subject");
    	$ticket->description = $request->get("description");
    	$ticket->date = $request->get("time");
    	$ticket->queue_id = 1;
        $ticket->location = $request->get("location");
        $ticket->picture = $request->get("picture", "images/a.png");
        $ticket->user_id = 1;
        $ticket_create = $ticket->save();

        if ($ticket_create) {

            return redirect()->route("user_page")->with(["success" => "TIcket created successfully"]);

        } else{

            return redirect()->route("user_page")->with(["failure" => "Ticket not created"]);

        }
    }
    // public function loginSubmit(Request $req) {
    // 	$email = $req->get("username");
    // 	$password = $req->get("password");

    // 	$user = Auth::attempt(['email' => $email, 'password' => $password]);

    // 	if(!$user){
    // 		return response()->with()->back();
    // 	}
    // }
}
