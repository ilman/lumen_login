<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	public function postRegister(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email|unique:users',
			'password' => 'required'
		]);
 
		try{
			$email = $request->input('email');
			$password = Hash::make($request->input('password'));
			$user = User::create([
				'email' => $email,
				'password' => $password,
			]);

			return $this->jsonSuccess(['message' => 'user_register_success', 'data' => $user]);
		}
		catch(Exception $e){
			Log::error($e);
			
			return $this->jsonError('user_register_failed');
		}
	}

	public function getUser(Request $request, $id)
	{
		$user = User::where('id', $id)->get();

		if ($user) {
			return $this->jsonSuccess(['data' => $user]);
		}
		else{
			return $this->jsonError('user_not_found', 404);
		}
	}

	public function postLogin(Request $request)
	{
		$email = $request->input('email');
		$password = $request->input('password');
		$user = User::where('email', $email)->first();
 
		if(!$user){
			return $this->jsonError('user_password_incorrect', 400);
		}

		try{
			if (Hash::check($password, $user->password)) {
				$api_token = sha1(time());
				User::where('id', $user->id)->update(['api_token' => $api_token]);

				return $this->jsonSuccess(['message' => 'user_login_success', 'data' => $user, 'api_token' => $api_token]);
			}
			else{
				return $this->jsonError('user_password_incorrect', 400);
			}
		}
		catch(Exception $e){
			Log::error($e);
			
			return $this->jsonError('user_login_failed');
		}
	}
}
