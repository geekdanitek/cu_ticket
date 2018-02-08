<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Queue;
use App\User;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    //
    public function index()
    {

        return view("cu_ticket_index");
    }

    public function user()
    {
        if (!session()->has('user')) {
            return redirect()->route("index")->with(["not_logged_in" => "Pls Login In"]);
        }


        $passed['users_ticket'] = Ticket::where("user_id", \Session::get('user')->id)->orderBy("created_at", "DESC")->get();
        $passed['queues'] = Queue::get();
        $passed["name"] = "User";
        // dd($passed);
        return view("cu_ticket_users", $passed);
    }

    public function adminLogin()
    {
    
        return view("cu_ticket_admin_login");
    }

    public function adminLoginSubmit(Request $request) {

        $email = $request->get("email");
        $password = $request->get("password");

        $u = Auth::guard('admin')->attempt(['email' => $email, 'password' => $password]);

        if($u) {

            $user = Auth::guard('admin')->user();
            session()->forget('user');
            session(['admin_user' => $user]);

            return redirect()->route('admin_page');
        }
        else {

            return redirect()->route('admin_login')->with(["login_error" => "Email or password invalid"]);
        }

    }

    public function admin() {
        if(!session()->has('admin_user') == true) {

            return redirect()->route('admin_login')->with(["not_logged_in" => "Pls Login In"]);
        }

        $passed['tickets_table'] = Ticket::orderBy("created_at", "ASC")->get();
        $passed['queues'] = Queue::get();

        $passed['total_amount'] = Ticket::count();
        $passed['open_amount'] = Ticket::where('status', 'new')->count();
        $passed['pending_amount'] = Ticket::where('status', 'inprogress')->count();
        $passed['rejected_amount'] = Ticket::where('status', 'rejected')->count();
        $passed['finished_amount'] = Ticket::where('status', 'finished')->count();
        $passed['name'] = "Admin";
        
        return view("cu_ticket_admin", $passed);
    }
    public function tickets($status = 'all')
    {
        $passed['name']= "Admin";
        $passed['queues'] = Queue::get();

        if ($status == 'all') {
            $passed['status_name'] = $status;
            $passed['tickets'] = Ticket::get();
        } else {
            $passed['tickets'] = Ticket::where('status', $status)->get();
            $passed['status_name'] = $status;
        }

        return view("cu_ticket_result", $passed);
    }

    public function ticketStatus()
    {
        $passed['name'] = "Admin";

        return view("cu_ticket_result", $passed);
    }

    public function showRegisterPage()
    {
        
        // $name = $request->get("email");
        // $all = $request->all();

        // dd($name, $all);
        $passed['name'] = "Admin";

        return view("cu_ticket_users_registration", $passed);
    }

    public function create(Request $request)
    {
        $email = $request->get("email");
        $matric_no = $request->get("matric_no");
        $staff_id = $request->get("staff_id");

        $email_check = User::where('email', $email)->count();
        if ($email_check > 0) {
            return redirect()->back()->with(["email_in_db" => "Email exist in Database"]);
        }

        if ($request->get('type') == 'staff') {
            $email_check = User::where('matric_no', $matric_no)->count();
            if ($email_check > 0) {
                return redirect()->back()->with(["matric_in_db" => "Matric number exist in Database"]);
            }
        } else {
            $email_check = User::where('staff_id', $staff_id)->count();
            if ($email_check > 0) {
                return redirect()->back()->with(["staffID" => "Staff ID exist in Database"]);
            }
        }

        $user = new User;
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->password = bcrypt($request->get("password"));
        $user->location = $request->get("location");
        $user->type = $request->get("type");
        if ($user->matric_no == null) {
            $user->matric_no = "";
        } else {
            $user->matric_no = $request->get("matric_no");
        }
        if ($user->staff_id == null) {
            $user->staff_id =  "";
        } else {
            $user->staff_id = $request->get("staff_id");
        }
        //dd($user->matric_no);
        $user_state = $user->save();
        if ($user_state) {
            return redirect()->route("login")->with(["reg_success" => "Registration successfull"]);
        }
    }

    public function login(Request $request)
    {
        $email = $request->get("email");
        $password = $request->get("password");
        // $email_check = User::where(["email" => $email, "passed"])->count();
        $user = Auth::attempt(['email' => $email, 'password' => $password]);
        // $u = User::where("email", $email)->first();

        
        // dd(Auth::check(), Auth::user());

        // Auth::login($u);

        if ($user) {
            // dd(\Auth::user());
            return redirect()->intended("user");
        } else {
            return redirect()->route("index")->with(["login_error"=>"Username or password invalid"]);
        }
    }

    public function createTicket(Request $request)
    {
        $ticket = new Ticket;
        $ticket->subject = $request->get("subject");
        $ticket->description = $request->get("description");
        $ticket->date = $request->get("time");
        $ticket->queue_id = $request->get("queue");
        $ticket->location = $request->get("location");
        $ticket->picture = $request->get("picture", "images/a.png");
        $ticket->user_id =  \Session::get('user')->id;
        $ticket_create = $ticket->save();

        if ($ticket_create) {
            return redirect()->route("user_page")->with(["success" => "TIcket created successfully"]);
        } else {
            return redirect()->route("user_page")->with(["failure" => "Ticket not created"]);
        }
    }

    public function update($id, Request $request)
    {
        $update = Ticket::find($id);
        $update->status = $request->get("status");
        $update_success = $update->save();

        if ($update_success) {
            return redirect()->back();
        }
    }
    public function loginSubmit(Request $req)
    {
        $email = $req->get("email");
        $password = $req->get("password");

        $u = Auth::attempt(['email' => $email, 'password' => $password]);

        if ($u) {
            $user = Auth::user();
            // $user = User::where("email", $email)->first();
            session()->forget('admin_user');
            session(['user' => $user]);

            return redirect()->route("user_page");
        } else {
            return redirect()->back()->with(["login_error" => "Email or password invalid"]);
        }
    }

    public function logout()
    {
        if(session()->has('user') == true) {

            session()->forget('user');

            return redirect()->route("index")->with(["logout_success" => "Log Out Successfull"]);
        }

        if(session()->has('admin_user') == true) {

            session()->forget("admin_user");

            return redirect()->route("admin_login")->with(["logout_success" => "Log Out Successfull"]);
    
        }
        
       
    }
}
