<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $rules = [

            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
           
            

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('error' => true, 'validation_error' => true, 'validation_message' => $validator->errors()));
        }

       
        $participant = new User;
        $participant->name = $request->name;
        $participant->email = $request->email;
        $participant->password = Hash::make($request);
        $participant->save();

        return response()->json(array('error' => false,  'messgae ' =>'registered'));

        
    }

    public function login(Request $request)
    {
        $user = User::where('email', request()->email)->first();
        if (!$user)
            return response()->json(array('error' => true));

        $success = !Hash::check(strtolower(request()->password), $user->password);

        $token= $user->createToken('token')->plainTextToken;
        Auth::login($user);
        return response()->json(['error' => $success,'token' => $token,'user' => $user]);
      
    }
}
