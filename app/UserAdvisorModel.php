<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class UserAdvisorModel extends Model

  {

  protected $table = 'user_advisor';

	//each user can have many user_advisors
	public function user(){
		return $this->hasOne('App\UserModel');
	}




	//TODO: add Relationship mappings

        //TODO: add Private Keys

  }

