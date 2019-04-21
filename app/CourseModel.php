<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class CourseModel extends Model

  {

  protected $table = 'course';

  
  //has many course_list course_id
  public function course_list(){
	  return $this->hasOne('App\UserModel', 'course_id', 'dep_id');
  }
  //has many course_list dep_id
  
  //has many major courses course_id
  public function major_course(){
	  return $this->hasMany('App\MajorCourseModel', 'course_id');
  }
  //has one department dep_id
  public function department(){
	  return $this->hasOne('App\DepartmentModel', 'dep_id');
  }
  
  //has many course_section course_id
  public function course_section(){
	  return $this->hasMany('App\CourseSectionModel', 'course_id');
  }
  
  
      //TODO: add Relationship mappings

        //TODO: add Private Keys

  }

