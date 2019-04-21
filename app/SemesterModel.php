<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class SemesterModel extends Model

  {

  protected $table = 'semester';
	
	//each semester has many course sections
	public function course_section(){
		return $this->hasMany('App\CourseSectionModel', 'semester_id');
	}
  
  
  
  
      //TODO: add Relationship mappings

        //TODO: add Private Keys

  }

