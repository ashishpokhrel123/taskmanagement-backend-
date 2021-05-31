<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

class AuthController extends Controller
{
    public function index(){
        return "hello lovely people";
    }
    /* register Api */

    
    public function signup(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
           
        ]);
            if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        
         return response()->json(['success'=>'created', $user]);
        } catch (\Throwable $th) {
            throw $th;
        }
         
    }

    /* Login Api */
    public function login(Request $request)
    {
        $credenentails = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        if(auth()->attempt($credenentails)){
            $token = auth()->user()->createToken('task')->accessToken;
            return response()->json(['token' => $token],  200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }


    }

    public function logout()
     {
      if (Auth::user()) {
        $user = Auth::user()->token();
        $user->revoke();

        return response()->json([
          'success' => true,
          'message' => 'Logout successfully'
      ]);
      }else {
        return response()->json([
          'success' => false,
          'message' => 'Unable to Logout'
        ]);
      }
     }
        
}
