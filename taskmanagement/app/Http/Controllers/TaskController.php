<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Validator;
use Auth;

class TaskController extends Controller
{
    public function createTask(Request $request)
    {

       
        $validator = Validator::make($request->all(), [ 
            'task' => 'required',
            
            
           
        ]);
         if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $token = auth('api')->user()->id;
        $taskInput = $request->all();
        $taskInput['user_id'] = $token;
        Task::create($taskInput);
        return response()->json(['message'=>'successfully, Task Created','data'=>$taskInput],201);
   
    
           
    
    }

    public function showtask()
    {
        $token = auth('api')->user()->id;
        $task = Task::with('users')->where('user_id', $token)->get();
        return response()->json($task,200);
    }

    public function getTaskbyId($id)
    {
        $token = auth('api')->user()->id;
        $task = Task::find($id);
        return response()->json($task, 200);

    }

    public function updateTask($id)
    {
        $task = new Task();
        $token =  $token = auth('api')->user()->id;
        $task = Task::find($id);
        $task->task = request()->task;
        $task->save();
        return response()->json(['message'=> 'Task Updated', 'data'=> $task], 201);
        

    }
    public function deleteTask($id)
    {
        $task = new Task();
        $token =  $token = auth('api')->user()->id;
        $task = Task::find($id);
        $task->delete();
        return response()->json(['message'=> 'Task Deleted', 'data'=> $task], 200);


    }
}
