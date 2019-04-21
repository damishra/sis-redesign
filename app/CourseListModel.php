<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class CourseListModel extends Model

  {

  protected $table = 'course_list';

  //has one user UID
  public function user(){
	  return $this->hasOne('App\UserModel', 'UID');
  }
  //has one grades grade
  public function grades(){
	  return $this->hasOne('App\GradesModel', 'grades');
  }
  //has one course course_id and dep_id
  public function course(){
	  return $this->hasOne('App\CourseModel', 'course_id', 'dep_id');
  }
  
  
  
      //TODO: add Relationship mappings

        //TODO: add Private Keys

  }

