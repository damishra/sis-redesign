<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public static function hellno()
    {
        return view('login');
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        session()->regenerate();
        try {
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required'
            ]);
        } catch (ValidationException $e) {
        }
        $username = $request->username;
        $password = $request->password;
        try {
            $user = DB::table('login')
                ->where('username', $username)
                ->first();
            $pass = $user->hash;
            if (Hash::check($password, $pass)) {
                session(['username' => $username]);
                session(['uid' => $user->UID]);
                $name = DB::table('user')
                    ->where('UID', session('uid'))
                    ->select(DB::raw("CONCAT(user.first_name, ' ', user.last_name) as name"), 'first_name', 'middle_name', 'last_name', 'email')
                    ->first();
                session(['name' => $name->name]);
                session(['data'=> $name]);
                $role = $user->role;
                session(['role' => $role]);
                if ($role == 1) {
                    return redirect('faculty');
                } else if ($role == 2) {
                    return redirect('student');
                } else {
                    return redirect('admin');
                }
            } else {
                return view('auth.login');
            }
        } catch (\Exception $e) {
            return view('auth.login');
        }
    }
    public static function password(Request $request){
        $user = session('username');

        DB::table('login')
            ->where('username','=',$user)
            ->update(['hash'=>Hash::make($request['password'])]);

    }
    public static function personal(Request $request) {
        $fn = $request->first;
        $mn = $request->middle;
        $ln = $request->last;
        $em = $request->email;
        DB::table('user')
            ->where('uid', session('uid'))
            ->update(['first_name'=>$fn, 'middle_name'=>$mn, 'last_name'=>$ln, 'email'=>$em]);
        $name = DB::table('user')
            ->where('UID', session('uid'))
            ->select(DB::raw("CONCAT(user.first_name, ' ', user.last_name) as name"), 'first_name', 'middle_name', 'last_name', 'email')
            ->first();
        session(['name' => $name->name]);
        session(['data'=> $name]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        session()->flush();
        return redirect('/auth/login');
    }

}
