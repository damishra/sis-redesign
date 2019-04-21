<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class RoleModel extends Model

  {

  protected $table = 'role';

  //one role can have many logins
  public function login(){
	  return $this->hasMany('App\LoginModel', 'role');
  }
  
  
  
      //TODO: add Relationship mappings

        //TODO: add Private Keys

  }

