<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 
  class GradeModel extends Model

  {

  protected $table = 'grades';

  //each grade is on many course lists
  public function course_list(){
	  return $this->hasMany('App\CourseListModel', 'grade');
  }
	
	
      //TODO: add Relationship mappings

        //TODO: add Private Keys

  }

