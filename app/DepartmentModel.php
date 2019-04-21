<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class DepartmentModel extends Model

  {

  protected $table = 'department';
	
	
	//one department can have many courses
	public function course(){
		return $this->hasMany('App\CourseModel', 'dep_id');
	}
	
	//dep ip conflict again, see MajorModel.php
	
	//one department can have many majors
	public function major(){
		return $this->hasMany('App\MajorModel');
	}
	
      //TODO: add Relationship mappings

        //TODO: add Private Keys

  }

