<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class CourseSectionUserModel extends Model

  {

  protected $table = 'course_section_user';

  
  public function user(){
	  return $this->hasOne('App\UserModel', 'UID');
  }
  public function course_section_enroll_type(){
	  return $this->hasOne('App\CourseSectionEnrollTypeModel', 'enrollment_id');
  }
  public function course_section(){
	  return $this->hasOne('App\CourseSectionModel', 'section_id');
  }
  
  
  
      //TODO: add Relationship mappings

        //TODO: add Private Keys

  }

