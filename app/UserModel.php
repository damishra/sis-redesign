<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class UserModel extends Model

  {

  protected $table = 'user';
	
	//one user can have many logins
	public function login(){
		return $this->hasMany('App\LoginModel', 'UID');    
	}
	
	//each user can have many user_advisors
	public function user_advisor(){
		return $this->hasMany('App\UserAdvisorModel');
	}
	
	//each user can have many 
	public function course_section_model(){
		return $this->hasMany('App\CourseSectionUserModel', 'UID');
	}
	//users can have many course_lists
	public function course_list(){
		return $this->hasMany('App\CourseListModel', 'UID');
	}
	
	//TODO: add Private Keys
  }

