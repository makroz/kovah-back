<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
  private $userName = 'email';
  public $__modelo = 'App\Models\User';


  private function loginAttemp(Request $request)
  {
    $password = $request->password;
    $username = $request->email;

    if (Auth::attempt(['email' => $username, 'password' => $password])) {
      $user             = Auth::user();
      $success['token'] = $user->createToken(env('APP_KEY', 'Kovah'))->plainTextToken;
      $success['user']  = $user;
      return $success;
    } else {
      return false;
    }
  }

  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => ['required'],
      'password' => ['required'],
    ]);

    if ($validator->fails()) {
      return response()->json(['status' => 'Unhautorized', 'errors' => ['message' => $validator->errors()]],);
    }

    $success = $this->loginAttemp($request);
    if ($success) {
      return response()->json(['status' => 'ok', 'data' => $success]);
    } else {
      return response()->json(['status' => 'Unhautorized', 'errors' => ['password' => 'Credenciales Erroneas']],);
    }
  }

  public function logout(Request $request)
  {
    Auth::user()->tokens()->delete();
    return response()->json(['message' => 'Successfully logged out Customers']);
  }

  public function username()
  {
    return $this->userName;
  }

  // public function guard()
  // {
  //   return Auth::guard('user');
  // }

}