<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;

class LoginController extends Controller
{
 
    //use this method to signin users
    public function signin(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match', 401);
        }
try{

      $token = $request->user()->createToken('default');

    return response()->json(['token' => $token->plainTextToken]);


    }catch (\Exception $e) 
      {
        
        return response()->json(['error' => $e,]);
       abort(404);
      }
    }

 
}
