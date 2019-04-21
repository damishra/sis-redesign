@if (session('role') == 3)
    @extends('layouts.app')

    @section('content')
        <div class="row"><h4>{{ session('name') }}</h4></div>
        <div class="row" onload="openCity(event, 'User')">
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'User')">User</button>
                <button class="tablinks" onclick="openCity(event, 'Section')">Section</button>
                <button class="tablinks" onclick="openCity(event, 'Account')">Account</button>
            </div>
            <div class="tabcontent" id="User">
                <div class="one-half column">
                    <h5>Create User</h5>
                    {!! Form::open(['action' =>'AdminController@makeUser', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('first', 'First Name')}}
                        {{Form::text('first', '', ['class' => 'u-full-width', 'placeholder' => 'Alex'])}}
                        {{Form::label('last', 'Last Name')}}
                        {{Form::text('last', '', ['class' => 'u-full-width', 'placeholder' => 'Userman'])}}
                        {{Form::label('user', 'Username')}}
                        {{Form::text('user', '', ['class' => 'u-full-width', 'placeholder' => 'auser1234'])}}
                        {{Form::label('role', 'Role')}}
                        {{Form::select('role', [1 => 'Faculty', 2 => 'Student'], null, ['class' => 'u-full-width', 'placeholder' => 'Select Account Type'])}}
                        <br/>
                        {{Form::submit('Add', ['class' => 'button-primary'])}}

                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="one-half column">
                    <h5>Update User</h5>

                    {!! Form::open(['action' =>'AdminController@updateUser', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('user', 'Username')}}
                        {{Form::text('user', '', ['class' => 'u-full-width', 'placeholder' => 'auser1234'])}}
                        {{Form::label('role', 'Role')}}
                        {{Form::select('role', [1 => 'Faculty', 2 => 'Student'], null, ['class' => 'u-full-width', 'placeholder' => 'Select Account Type'])}}
                        {{Form::label('newUser', 'Username for new role')}}
                        {{Form::text('newUser', '', ['class' => 'u-full-width', 'placeholder' => 'auser1234'])}}
                        <br/>
                        {{Form::submit('Update', ['class' => 'button-primary'])}}

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="tabcontent" id="Section">
                <div class="one-third column">
                    <?php
                    $prof_list = [];
                    $professors = \Illuminate\Support\Facades\DB::table('login')
                        ->join('user','login.UID','=','user.UID')
                        ->where('login.role',1)
                        ->select('user.UID AS uid', DB::raw("CONCAT(user.first_name, ' ', user.last_name) as name"))
                        ->get();
                    foreach ($professors as $prof){
                        $prof_list[$prof->uid]=$prof->name;
                    }
                    $class_list = [];
                    $class = \Illuminate\Support\Facades\DB::table('course')
                        ->select('title', 'course_id')
                        ->get();
                    foreach ($class as $c){
                        $class_list[$c->course_id]=$c->title;
                    }
                    ?>
                    <h5>Create Section</h5>
                    {!! Form::open(['action' =>'AdminController@makeSection', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('course_id', 'Course Name')}}
                        {{Form::select('course_id', $class_list, null, ['class' => 'u-full-width'])}}
                        {{Form::label('section_id', 'Section ID')}}
                        {{Form::text('section_id', '', ['class' => 'u-full-width', 'placeholder' => 'Satanic Rituals 141'])}}
                        {{Form::label('prof', 'Professor')}}
                        {{Form::select('prof', $prof_list, null, ['class' => 'u-full-width'])}}
                        <br/>
                        {{Form::submit('Add',['class' => 'button-primary'])}}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="one-third column">
                    <h5>Update Section</h5>
                    {!! Form::open(['action' =>'AdminController@updateSection', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('section_id', 'Section ID')}}
                        {{Form::text('section_id', '', ['class' => 'u-full-width', 'placeholder' => 'Satanic Rituals 141'])}}
                        {{Form::label('prof', 'New Professor')}}
                        {{Form::select('prof', $prof_list, null, ['class' => 'u-full-width'])}}
                        <br/>
                        {{Form::submit('Update',['class' => 'button-primary'])}}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="one-third column">
                    <h5>Delete Section</h5>
                    {!! Form::open(['action' =>'AdminController@deleteSection', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('section_id', 'Section ID')}}
                        {{Form::text('section_id', '', ['class' => 'u-full-width', 'placeholder' => '1234'])}}
                        <br/>
                        {{Form::submit('Delete', ['class' => 'button-primary'])}}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div id = 'Account' class = 'tabcontent'>
                {!! Form::open(['action' => 'AdminController@personal', 'method' => 'POST', 'class' => 'one-half column']) !!}
                <div class="form-group">
                    {{Form::label('first', 'First Name')}}
                    {{Form::text('first', session('data')->first_name, ['class' => 'u-full-width'])}}
                    {{Form::label('middle', 'Middle Name')}}
                    {{Form::text('middle', session('data')->middle_name, ['class' => 'u-full-width'])}}
                    {{Form::label('last', 'Last Name')}}
                    {{Form::text('last', session('data')->last_name, ['class' => 'u-full-width'])}}
                    {{Form::label('email', 'Email')}}
                    {{Form::email('email', session('data')->email, ['class' => 'u-full-width'])}}
                    <br/>
                    {{Form::submit('Update Personal Details', ['class' => 'button-primary u-full-width'])}}
                </div>
                {!! Form::close() !!}
                {!! Form::open(['action' => 'AdminController@password', 'method' => 'POST', 'class' => 'one-half column']) !!}
                <div class="form-group">
                    {{Form::label('password', 'New Password', ['class' => 'button-primary u-full-width'])}}
                    {{Form::password('password', ['class' => 'button-primary u-full-width'])}}
                    <br/>
                    {{Form::submit('Update Password', ['class' => 'button-primary u-full-width'])}}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">
            <a href="{{ url('logout') }}">Logout</a>
        </div>
    @endsection
@else
    <?php \App\Http\Controllers\LoginsController::hellno() ?>
@endif
