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
            return redirect()->route("index")->with(["flash_msg" => "Please login in to continue", "type" => "danger"]);
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

            return redirect()->route('admin_login')->with(["flash_msg" => "Email or password invalid", "type" => "danger"]);
        }

    }

    public function admin() {
        if(!session()->has('admin_user') == true) {

            return redirect()->route('admin_login')->with(["flash_msg" => "Please login in to continue", "type" => "danger"]);
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

            return redirect()->route('admin_login')->with(["flash_msg" => "Please login in to continue", "type" => "danger"]);
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
        $type = $request->get("type");
        $matric_no = $request->get("matric_no");
        $staff_id = $request->get("staff_id");



        //dd([$email, $type, $matric_no, $staff_id]);

        //form email input checking

        $e = explode("@",$email);
        $em = ["stu.cu.edu.ng"];
        $ems = ["covenantuniversity.edu.ng"];

        if($type == 'student' AND !in_array($e[1], $em)) {

              return redirect()->back()->with(["flash_msg" => "Email <b>$email</b> not accepted", "type" => "danger"]);
        }

        if($type == 'staff' AND !in_array($e[1], $ems)) {

            return redirect()->back()->with(["flash_msg" => "Email <b>$email</b> not accepted", "type" => "danger"]);

        }  
        
        if($type == 'staff'){


            if(strpos($staff_id, "CU") === false) {
                return redirect()->back()->with(["flash_msg" => "Staff ID not valid", "type" => "danger"]);
            }
        }
       
        if ($type == 'staff') {

        $sc = explode("U", $staff_id);
        $scl = strlen($sc[1]);
       

            if($scl !== 5) {

             return redirect()->back()->with(["flash_msg" => "Staff ID Length not valid", "type" => "danger"]);            
           }

        }
      

        $email_check = User::where('email', $email)->count();
        if ($email_check > 0) {
            return redirect()->back()->with(["flash_msg" => "Email exist in Database", "type" => "danger"]);
        }

        if ($request->get('type') == 'staff') {
            $email_check = User::where('matric_no', $matric_no)->count();
            if ($email_check > 0) {
                return redirect()->back()->with(["flash_msg" => "Matric number exist in Database", "type" => "danger"]);
            }
        } else {
            $email_check = User::where('staff_id', $staff_id)->count();
            if ($email_check > 0) {
                return redirect()->back()->with(["flash_msg" => "Staff ID exist in Database", "type" => "danger"]);
            }
        }

        $user = new User;
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->password = bcrypt($request->get("password"));
        $user->location = $request->get("location");
        $user->type = $request->get("type");
        
        if ($request->get("matric_no") == null) {
            $user->matric_no = "";
        } else {
            $user->matric_no = $request->get("matric_no");
        }
        if ($request->get("staff_id") == null) {
            $user->staff_id =  "";
        } else {
            $user->staff_id = $request->get("staff_id");
        }
        //dd($user->matric_no);
        $user_state = $user->save();
        if ($user_state) {
            return redirect()->route("login")->with(["flash_msg" => "Registration successfull", "type" => "success"]);
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
            return redirect()->route("index")->with(["flash_msg"=>"Username or password invalid", "type" => "danger"]);
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
           $queue_type = Queue::find($request->get("queue"));
            
            $mail_to = \Session::get('user')->email;

            $subject = "CU Ticket System";

            $queue_mail = "<h1>"."Dear"." ".\Session::get('user')->name."</h1>";
            $queue_mail .= "<h4>"."You created a queue"."</h4>";
            $queue_mail .= "<h4>"."Queue subject: ".$request->get("subject")."</h4>";
            $queue_mail .= "<h4>"."Queue description: ".$request->get("description")."</h4>";
            $queue_mail .= "<h4>"."Available Date: ".$request->get("time")."</h4>";
            $queue_mail .= "<h4>"."Queue Type: ".$queue_type->name."</h4>";
            $queue_mail .= "<h4>"."Location: ".$request->get("location")."</h4>";
            $queue_mail .= "<p>"."At"." ".date("d/m/Y  h:i:s a") ."</p>";

            
            $header = "CU Ticket System \r\n";

            $header .= "MIME-Version: 1.0\r\n";

            $header .= "Content-type: text/html \r\n";  
            
            mail($mail_to, $subject, $queue_mail, $header);

            return redirect()->route("user_page")->with(["flash_msg" => "TIcket created successfully", "type" => "success"]);
        } else {
            return redirect()->route("user_page")->with(["flash_msg" => "Ticket not created", "type" => "danger"]);
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
            //dd($user);
            // $user = User::where("email", $email)->first();
            session()->forget('admin_user');
            session(['user' => $user]);

            return redirect()->route("user_page");
        } else {
            return redirect()->back()->with(["flash_msg" => "Email or password invalid", "type" => "danger"]);
        }
    }



    public function createQueues(Request $request) {

        $name = $request->get("name");

        $name_check = Queue::where("name", $name)->count();
        if($name_check > 0) {

            return redirect()->back()->with(["flash_msg" => "Queue Name Exist In Database", "type" => "danger"]);
        }

        $add_queues = new Queue;
        $add_queues->name = $name;
        $add_queues_success = $add_queues->save();

        if($add_queues_success) {


            return redirect()->back()->with(["flash_msg" => "Queue Add successfully", "type" => "success"]);
        }
        else {

            return redirect()->back()->with(["flash_msg" => "Queue Not Added", "type" => "danger"]); 
        }
    }

    public function createAdmin(Request $request) {

        $name = $request->get("name");
        $email = $request->get("email");
        $password = bcrypt($request->get("password"));
        $type = $request->get("type");

        $e = explode("@",$email);
        $ems = ["covenantuniversity.edu.ng"];

        if(!in_array($e[1], $ems)) {

              return redirect()->back()->with(["flash_msg" => "Email <b>$email</b> not accepted", "type" => "danger"]);
        }


        $email_check = AdminUser::where("email", $email)->count();
        if ($email_check > 0) {

            return redirect()->back()->with(["flash_msg" => "Email Exist In Database", "type" => "danger"]);
        }
        $add_user = new AdminUser;
        $add_user->name = $name;
        $add_user->email = $email;
        $add_user->password = $password;
        $add_user->type = $type;

        $add_user_success = $add_user->save();

        if($add_user_success) {

            return redirect()->back()->with(["flash_msg" => "User Added successfully", "type" => "success"]);
        }
        else {

            return redirect()->back()->with(["flash_msg" => "User Not Added successfully", "type" => "danger"]);
        }



    }
    //reset password area for the user side
    public function reset() {

        return view("cu_ticket_reset");
    }

    public function resetAction(Request $request) {

        $email = $request->get("email");
        $resetUser = User::where("email", $email)->first();
    
        if(!$resetUser) {

            return redirect()->back()->with(["flash_msg" => "Email not in the database", "type" => "danger"]);
        }

        $reset_rand = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");

        $resetUser->reset_password = $reset_rand;

        $resetUser->save();

        $link = route("reset_page", ["rand" => $reset_rand]);
        //SEND EMAIL
            $mail_to = $resetUser->email;

            $subject = "CU Ticket System Password Reset";

            $queue_mail = "<h1>"."Dear"." ".$resetUser->name."</h1>";
            $queue_mail .= "<h4>"."Your Password reset link is"."</h4>";
            $queue_mail .= "<h4>".$link."</h4>";
            
            $header = "CU Ticket System \r\n";

            $header .= "MIME-Version: 1.0\r\n";

            $header .= "Content-type: text/html \r\n";  
            
            // mail($mail_to, $subject, $queue_mail, $header);

            return redirect()->back()->with(["flash_msg" => "Email link sent: ".$link, "type" => "success"]);
    }
    public function resetPasswordView($rand) {

        $resetUser = User::where("reset_password", $rand)->first();

        if(!$resetUser){

        //Not a valid link ba Enefem group of school, Address : 9-11 Adebayo str off amule - olayemi road, makinde bustop ashipa ayobo

            return redirect()->route("reset")->with(["flash_msg" => "The link is not valid", "type" => "danger"]);

        }
        $email = $resetUser->email;
        return view("cu_ticket_reset_password", ["email" => $email]);
    }
    public function resetPassword(Request $request) {
            $email = $request->get("email");
            $new_pin = $request->get("new_pin");
            $confirm_pin = $request->get("confirm_pin");

            if ($new_pin !== $confirm_pin) {
                return redirect()->back()->with(["flash_msg" => "Try again! The your new passwords don't match", "type" => "warning"]);
            }

            $resetUser = User::where("email", $email)->first();
            $resetUser->password = bcrypt($confirm_pin);
            $resetUser->reset_password = null;
            $resetUser->save();
            
            return redirect()->route("login")->with(["flash_msg" => "Password has been reset. Please Login", "type" => "success"]);
    }
    //reset password for admin side
    public function resetAdmin() {
        return view("cu_ticket_reset_admin");
    }

    public function resetActionAdmin(Request $request) {

        $email = $request->get("email");
        $resetUser = AdminUser::where("email", $email)->first();
    
        if(!$resetUser) {

            return redirect()->back()->with(["flash_msg" => "Email not in the database", "type" => "danger"]);
        }

        $reset_rand = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");

        $resetUser->reset_password = $reset_rand;

        $resetUser->save();

        $link = route("reset_page_admin", ["rand" => $reset_rand]);
        //SEND EMAIL
            $mail_to = $resetUser->email;

            $subject = "CU Ticket System Password Reset";

            $queue_mail = "<h1>"."Dear"." ".$resetUser->name."</h1>";
            $queue_mail .= "<h4>"."Your Password reset link is"."</h4>";
            $queue_mail .= "<h4>".$link."</h4>";
            
            $header = "CU Ticket System \r\n";

            $header .= "MIME-Version: 1.0\r\n";

            $header .= "Content-type: text/html \r\n";  
            
            // mail($mail_to, $subject, $queue_mail, $header);

            return redirect()->back()->with(["flash_msg" => "Email link sent: ".$link, "type" => "success"]);
    }
    public function resetPasswordViewAdmin($rand) {

        $resetUser = AdminUser::where("reset_password", $rand)->first();

        if(!$resetUser){

        //Not a valid link

            return redirect()->route("reset")->with(["flash_msg" => "The link is not valid", "type" => "danger"]);

        }
        $email = $resetUser->email;
        return view("cu_ticket_reset_password_admin", ["email" => $email]);
    }
    public function resetPasswordAdmin(Request $request) {
            $email = $request->get("email");
            $new_pin = $request->get("new_pin");
            $confirm_pin = $request->get("confirm_pin");

            if ($new_pin !== $confirm_pin) {
                return redirect()->back()->with(["flash_msg" => "Try again! The your new passwords don't match", "type" => "warning"]);
            }

            $resetUser = AdminUser::where("email", $email)->first();
            $resetUser->password = bcrypt($confirm_pin);
            $resetUser->reset_password = null;
            $resetUser->save();
            
            return redirect()->route("admin_login")->with(["flash_msg" => "Password has been reset. Please Login", "type" => "success"]);
    }


    public function logout()
    {
        if(session()->has('user') == true) {

            session()->forget('user');

            return redirect()->route("index")->with(["flash_msg" => "Logged Out successfully", "type" => "success"]);
        }

        if(session()->has('admin_user') == true) {

            session()->forget("admin_user");

            return redirect()->route("admin_login")->with(["flash_msg" => "Log Out successfully", "type" => "success"]);
    
        }
        
       
    }

}



