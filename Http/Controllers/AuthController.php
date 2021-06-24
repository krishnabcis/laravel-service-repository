<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\LoginRequest;

class AuthController extends Controller {
  /**
    * Login api
    *
    * @return \Illuminate\Http\Response
    */

  public function login(LoginRequest $request) {
    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      $user = Auth::user(); 
      $success['token'] =  $user->createToken('MyApp')-> accessToken;
      $success['name'] =  $user->name;
      $success['status'] =  200;
      return response()->json($success, 200);
    }
    else {
      return response()->json([ 'message'=>'Invalid Login'], 202);
    }
  }
}
