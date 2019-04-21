<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class CourseSectionEnrollTypeModel extends Model

  {

  protected $table = 'course_section_enroll_type';

  
  //has many course section user
  public function course_section_user(){
	  return $this->hasMany('App\CourseSectionUserModel', 'enrollment_id');
  }
  
  
      //TODO: add Relationship mappings

        //TODO: add Private Keys

  }

