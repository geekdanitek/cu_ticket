<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Task;

class TaskController extends Controller
{
    //

    public function taskindex() {

    	
	$tasks = Task::get();

	   return view("tasks.index", ["tasks" => $tasks]);

    }

    public function completed() {

        $tasks = Task::where('completed', 1)->get();
    	// dd($tasks);
    	$passed = ["tasks" => $tasks, "page_name" => "List of completed tasks", "title" => "Completed"];

    	return view("tasks.tasks_completed", $passed);

    }

    public function notcompleted() {

        $tasks = Task::where('completed', 0)->get();
    	$passed = ["tasks" => $tasks, "page_name" => "List of not completed tasks", "title" => "Not completed"];

    	return view("tasks.tasks_completed", $passed);

    }
    public function showtask($id = null) {

    	$tasks = Task::find($id);

         return view("tasks.show", ["id" => $id, "task"=>$tasks]);


    }
}
