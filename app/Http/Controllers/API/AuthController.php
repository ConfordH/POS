<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AuthController extends Controller
{
    /*
    User being able to register.
    */
    public function register(Request $request){
        $validate  = $request->validate([
            'full_name' => 'required',
            'email'     => 'required|email',
            'password'  => 'required'
        ]);
        if(!$validate){
            return response()->json([
                'message' => 'Error. Something went wrong. Please Check your information. Try again', 
                'result' => [], 'status_code' => 400 ]);
        }else{
            $user  = User::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            return response()->json([
                'message' => 'Successfully Created your account', 
                'result' => ['username' => $request->email], 'status_code' => 201 ]);
        }
    }

    /*
    User login 
    */
   public function login(Request $request){
       $validate = $request->validate([
           'username' => 'required|email',
           'password' => 'required'
       ]);
       $credentials = [
           'email' => $request->username,
           'password' => $request->password
       ];

       if(!$validate){
        return response()->json([
            'message' => 'Error. Please provide all information as required', 
            'result' => [], 'status_code' => 403 ]);
       }else{
        if(auth()->attempt($credentials)){
            $token = auth()->user()->createToken('omambia-cherry')->accessToken;
            return response()->json([
                'message' => 'Success', 
                'token' => $token,
                'result' => [
                    'logged_in_as' => auth()->user()->name] 
            ]);
        }else{
            return response()->json(['error' => 'Unauthenticated', 'status_code' => 401], 401);
        }
       }
       
   }

   /*
   User profile details
   */
  public function profile(){
      return response()->json([
          'message' => "Sucess",
          'results' => ['user' => auth()->user()],
          'status_code' => 200], 200);
  }

}
