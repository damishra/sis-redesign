<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if(session('role') == 2) {
                $user = DB::table('course_list')
                    ->join('course_section', 'course_list.section_id', '=', 'course_section.section_id')
                    ->join('course', 'course_section.course_id', '=', 'course.course_id')
                    ->join('grades', 'course_list.grade', '=', 'grades.grade')
                    ->where('course_list.UID', session('uid'))
                    ->select('course.title AS title', 'course.credits AS credits', 'grades.grade AS grade', 'grades.weightage AS weight','course_list.section_id AS section')
                    ->get();
                return view('student.student', ['user' => $user]);
            }
            else if (session('role') == 1) {
                return redirect('/faculty');
            }
            else {
                return redirect('/admin');
            }
        } catch(\Exception $e) {
            session()->flush();
            session()->regenerate();
            return redirect('/auth/login')
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * @param Request $request
     */
    public function enroll(Request $request) {
        //Dishant you little shit, the default grade wasn't in the grades table
        try {
            $uid = session('uid');
            //$user = session('username');
            $section = $request['section'];
            DB::table('course_list')
                ->insert(['section_id' => $section, 'UID' => $uid, 'semester_id' => '1', 'grade' => '-']);
        }
        catch (\Exception $e){}

        return redirect('/student');

    }
    public function drop(Request $request){
        $section = $request['section'];
        $uid = $request['uid'];
        DB::table('course_list')
            ->where(['section_id'=>$section, 'UID'=>$uid])
            ->delete();
        return redirect('/student');
    }
    public function personal(Request $request) {
        LoginsController::personal($request);
        return redirect('/student');
    }
    public function password(Request $request) {
        LoginsController::password($request);
        return redirect('/student');
    }

   

}
