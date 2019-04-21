<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class MajorModel extends Model

  {

  protected $table = 'major';

  //each major has many major courses
  public function major_course(){
	  return $this->hasMany('App\MajorCourseModel', 'major_id');
  }
  
  //concern with db dept and major, is dep_id and deparement respectivly 
  //the same thing? if so they could be named the same
  
  //each major has one department
  public function department(){
	  return $this->hasOne('App\DepartmentModel', 'dep_id');
  }
  
  
  
      //TODO: add Relationship mappings

        //TODO: add Private Keys

  }

