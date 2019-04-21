<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
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
            $det = DB::table('user')->where('uid', $uid)->get()->toArray();

            return view('admin.admin', ['det' => $det]);
        } catch (\Exception $e) {
            session()->flush();
            session()->regenerate();
            return redirect('/auth/login')
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    public function makeUser(Request $request)
    {
        try {
            $this->validate($request, [
                'first' => 'required',
                'last' => 'required',
                'user' => 'required',
                'role' => 'required'
            ]);
        } catch (ValidationException $e) {
        }
        $first=$request->first;
        $last=$request->last;
        $user=$request->user;
        $role=$request->role;
        DB::beginTransaction();
        /*
         * you need to get the uid
         * */
        try {
            $uid =DB::table('user')
                ->insertGetId(['first_name'=>$first,'last_name'=>$last],'uid');
            DB::table('login')
                ->insert(
                    ['username'=>$user, 'role'=>$role, 'hash'=>Hash::make('password'), 'UID'=>$uid]
                );
        } catch(ValidationException $e)
        {
            DB::rollback();
        } catch (\Exception $e) {
            DB::rollback();
        }
        DB::commit();
        return view('admin.admin');
    }

    /**
     * @param Request $request
     */
    public function updateUser(Request $request)
    {
        try {
            $this->validate($request, [
                'user' => 'required',
                'role' => 'required',
                'newUser' => 'required'
            ]);
        } catch (ValidationException $e) {
        }
        $u=$request->user;
        $r=$request->role;
        $nu=$request->newUser;
        DB::beginTransaction();
        try {
            $uid = DB::table('login')
                ->select('UID')
                ->where('username', $u)
                ->first();
            DB::table('login')
                ->insert(
                    ['username'=>$nu, 'role'=>$r, 'hash'=>'password', 'UID'=>$uid]
                );
        } catch (\Exception $e) {
            DB::rollback();
        }
        DB::commit();
        return view('admin.admin');
    }

    public function makeSection(Request $request) {
        try {
            $this->validate($request, [
                'course_id' => 'required',
                'section_id' => 'required',
                'prof' => 'required'
            ]);
            $cid = $request->course_id;
            $sid = $request->section_id;
            $pid = $request->prof;
            DB::table('course_section')
                ->insert(['course_id'=>$cid,'section_id'=>$sid,'prof_id'=>$pid]);
        } catch(\Exception $e) {

        }

        return view('admin.admin');
    }

    public function updateSection(Request $request) {
        try {
            $this->validate($request, [
                'section_id' => 'required',
                'prof' => 'required'
            ]);
            $sid = $request->section_id;
            $pid = $request->prof;
            DB::table('course_section')
                ->where('section_id', $sid)
                ->update(['prof_id'=>$pid]);
        } catch(\Exception $e) {

        }

        return view('admin.admin');
    }

    public function deleteSection(Request $request) {
        try {
            $this->validate($request, [
                'section_id' => 'required'
            ]);
            $sid = $request->section_id;
            DB::table('course_section')
                ->where('section_id', $sid)
                ->delete();
        } catch(\Exception $e) {

        }

        return view('admin.admin');
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
