<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class LoginModel extends Model

  {

  protected $table = 'login';

  //login has one role
  public function role(){
	  return $this->hasOne('App\RoleModel', 'role');
  }
  
  //login has one user_error
  public function user(){
	  return $this->hasOne('App\UserModel', 'UID');
  }
  
  
      //TODO: add Relationship mappings

        //TODO: add Private Keys

  }

