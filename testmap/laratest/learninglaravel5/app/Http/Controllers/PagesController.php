<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    //

	public function about()
	{
		//return "test";
		$name = "something";
		return view("pages.about", compact('name'));
	}

	public function login()
	{
		//return "test";
		$name = "Login";
		return view("pages.login", compact('name'));
	}



	public function registreer()
	{
		//return "test";
		$name = "Registreer";
		return view("pages.registreer", compact('name'));
	}

}
