<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DB;
use App\users;
use App\User;
use Request;


class UsersController extends Controller
{
    //

	public function about()
	{
		//return "test";
		$name = "something";
		return view("pages.about", compact('name'));
	}

	public function store(){

		$input = Request::all();
		var_dump($input);
		$user = new User();

		$user->name = $input['name'];
		$user->password = $input['password'];
		$user->email = $input["email"];
		//users::create($input);
		$user->save();
		//echo 'ok';

	}


	public function checklogin(){

		$input = Request::all();
		var_dump($input);
		$email = $input["email"];
		$password = $input["password"];
		var_dump($password);

		echo 'check login';

		$user = User::find($email);
		var_dump(User::all());

		$user = User::find($email); //DB::table('users')->where('name', 'wim')->first();

		var_dump($user);

	}


}
