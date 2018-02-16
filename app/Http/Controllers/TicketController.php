<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Queue;
use App\User;
use App\AdminUser;
use Illuminate\Support\Facades\Auth;
use App\ade;

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
            return redirect()->route("index")->with(["not_logged_in" => "Please Login In To Continue", "type" => "danger"]);
        }


        $passed['users_ticket'] = Ticket::where("user_id", \Session::get('user')->id)->orderBy("created_at", "DESC")->get();
        $passed['users_ticket_new'] = Ticket::where("user_id", \Session::get('user')->id)->where("status", "new")->get();
        $passed['users_ticket_inprogress'] = Ticket::where("user_id", \Session::get('user')->id)->where("status", "inprogress")->get();
        $passed['users_ticket_rejected'] = Ticket::where("user_id", \Session::get('user')->id)->where("status", "rejected")->get();
        $passed['users_ticket_finished'] = Ticket::where("user_id", \Session::get('user')->id)->where("status", "finished")->get();
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

            return redirect()->route('admin_login')->with(["login_error" => "Email or password invalid", "type" => "danger"]);
        }

    }

    public function admin() {
        if(!session()->has('admin_user') == true) {

            return redirect()->route('admin_login')->with(["not_logged_in" => "Please Login In To Continue", "type" => "danger"]);
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

         if(!session()->has('admin_user') == true) {

            return redirect()->route('admin_login')->with(["not_logged_in" => "Please Login In To Continue", "type" => "danger"]);
        }

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

        //form email input checking

        $e = explode("@",$email);

        $em = ["gmail.com", "covenantuniversity.edu.ng"];

        if(!in_array($e[1], $em)) {

            return redirect()->back()->with(["email_domain_not_trusted" => "Please Use A Valid Email", "type" => "danger"]);
        }
        



        $email_check = User::where('email', $email)->count();
        if ($email_check > 0) {
            return redirect()->back()->with(["email_in_db" => "Email exist in Database", "type" => "danger"]);
        }

        if ($request->get('type') == 'staff') {
            $email_check = User::where('matric_no', $matric_no)->count();
            if ($email_check > 0) {
                return redirect()->back()->with(["matric_in_db" => "Matric number exist in Database", "type" => "danger"]);
            }
        } else {
            $email_check = User::where('staff_id', $staff_id)->count();
            if ($email_check > 0) {
                return redirect()->back()->with(["staffID" => "Staff ID exist in Database", "type" => "danger"]);
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
            return redirect()->route("login")->with(["reg_success" => "Registration successfull", "type" => "success"]);
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
            return redirect()->route("index")->with(["login_error"=>"Username or password invalid", "type" => "danger"]);
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
        // $ticket->picture = $request->get("picture", "images/a.png");
        $ticket->user_id =  \Session::get('user')->id;
        $ticket_create = $ticket->save();

        if ($ticket_create) {
            return redirect()->route("user_page")->with(["success" => "TIcket created successfully", "type" => "success"]);
        } else {
            return redirect()->route("user_page")->with(["failure" => "Ticket not created", "type" => "danger"]);
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
            return redirect()->back()->with(["login_error" => "Email or password invalid", "type" => "danger"]);
        }
    }



    public function createQueues(Request $request) {

        $name = $request->get("name");

        $name_check = Queue::where("name", $name)->count();
        if($name_check > 0) {

            return redirect()->back()->with(["name_in_db" => "Queue Name Exist In Database", "type" => "danger"]);
        }

        $add_queues = new Queue;
        $add_queues->name = $name;
        $add_queues_success = $add_queues->save();

        if($add_queues_success) {

            return redirect()->back()->with(["add_queues_success" => "Queue Add successfully", "type" => "success"]);
        }
        else {

            return redirect()->back()->with(["add_queues_failure" => "Queue Not Added", "type" => "danger"]); 
        }
    }

    public function createAdmin(Request $request) {

        $name = $request->get("name");
        $email = $request->get("email");
        $password = bcrypt($request->get("password"));
        $type = $request->get("type");
        $email_check = AdminUser::where("email", $email)->count();

        if ($email_check > 0) {

            return redirect()->back()->with(["email_in_db" => "Email Exist In Database", "type" => "danger"]);
        }
        $add_user = new AdminUser;
        $add_user->name = $name;
        $add_user->email = $email;
        $add_user->password = $password;
        $add_user->type = $type;

        $add_user_success = $add_user->save();

        if($add_user_success) {

            return redirect()->back()->with(["add_user_success" => "User Added successfully", "type" => "success"]);
        }
        else {

            return redirect()->back()->with(["add_user_failure" => "User Not Added successfully", "type" => "danger"]);
        }



    }
    public function logout()
    {
        if(session()->has('user') == true) {

            session()->forget('user');

            return redirect()->route("index")->with(["logout_success" => "Logged Out successfully", "type" => "success"]);
        }

        if(session()->has('admin_user') == true) {

            session()->forget("admin_user");

            return redirect()->route("admin_login")->with(["logout_success" => "Log Out successfully", "type" => "success"]);
    
        }
        
       
    }

}



