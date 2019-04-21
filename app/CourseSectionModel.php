<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class CourseSectionModel extends Model

  {

  protected $table = 'course_section';

  
  
  //has many course section users
  public function course_section_user(){
	  return $this->hasMany('App\CourseSectionUserModel', 'section_id');
  }
  //has one semester
  public function semester(){
	  return $this->hasOne('App\SemesterModel', 'semester_id');
  }
  //has one course
  public function course(){
	  return $this->hasOne('App\CourseModel', 'course_id');
  }
      //TODO: add Relationship mappings

        //TODO: add Private Keys

  }

