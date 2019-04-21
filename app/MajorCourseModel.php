<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class MajorCourseModel extends Model

  {

  protected $table = 'major_course';

  //each course for your major has one major
  public function major(){
	  return $this->hasOne('App\MajorModel', 'major_id');
  }
  
  //each major course has one class
  public function course(){
	  return $this->hasOne('App\CourseModel', 'course_id');
  }
  
  
  
      //TODO: add Relationship mappings

        //TODO: add Private Keys

  }

