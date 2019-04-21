<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $username = session('username');
            $login = DB::table('login')->where('username', $username)->first();
            $uid = $login->UID;
            $map = [];
            $det = DB::table('course_section')
                ->join('course', 'course.course_id', '=', 'course_section.course_id')
                ->where('course_section.prof_id', '=', $uid)
                ->select('course_section.section_id AS section', 'course.title AS title')
                ->get();
            foreach($det as $sec)
                $map[$sec->section] = $sec->title;
            session(['det'=>$det, 'map'=>$map]);
            return view('faculty.faculty');
        } catch (\Exception $e) {
            session()->flush();
            session()->regenerate();
            return redirect('/auth/login')
            ->withErrors($e->getMessage())
            ->withInput();
        }
    }

    public static function classList() {
            $uid = session('uid');
                $cl = DB::table('course_section')
                    ->where('prof_id', $uid)
                    ->select('section_id')
                    ->get();
                $list = [];
                foreach($cl as $c) {
                    $c = $c->section_id;
                    $list[$c] = DB::table('course_list')
                        ->join('course_section', 'course_section.section_id', '=', 'course_list.section_id')
                        ->join('course', 'course.course_id', '=', 'course_section.course_id')
                        ->join('user', 'user.UID', '=', 'course_list.UID')
                        ->where('course_list.section_id',$c)
                        ->select(DB::raw("CONCAT(user.first_name, ' ', user.last_name) as name"), 'user.UID AS uid', 'course.title AS title')
                        ->get();
                }
                session(['class_list' => $list]);
    }

    public function updateGrade(Request $request) {
            $this->validate($request, [
                'section_id' => 'required',
                'uid' => 'required',
                'grade' => 'required'
            ]);
            $sid = $request->section_id;
            $uid = $request->uid;
            $grade = $request->grade;

            DB::table('course_list')
                ->where('section_id', $sid)
                ->where('UID', $uid)
                ->update(['grade'=>$grade]);

        return view('faculty.faculty');
    }

    public function password(Request $request){
            LoginsController::password($request);
            return redirect('/faculty');
    }

    public function personal(Request $request){
        LoginsController::personal($request);
        return redirect('/faculty');
    }
}
