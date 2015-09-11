<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    //
   protected $fillable = ['name', 'password' ];
   protected $table = 'users';


   public static function create(array $data = array()){

    	//echo 'create new user';
    	
    	/*$user = new Users();

    	//$input->save();
    	$user['name'] = $input['name'];
    	$user['password']=$input['pasword'];

    	$user->save();*/

    }

}
