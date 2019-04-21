@if (session('role') == 2)
    @extends('layouts.app')

    @section('title', 'Student')

    @section('sidebar')
        @parent
    @endsection

    @section('content')
            <div class="row"><h4>{{session('name')}}</h4></div>
            <div class="row" onload = "openCity(event, 'Courses')">
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'Courses')">Courses</button>
                    <button class="tablinks" onclick="openCity(event, 'Enroll')">Enroll</button>
                    <button class="tablinks" onclick="openCity(event, 'Account')">Account</button>
                </div>
                <div id = 'Courses' class = 'tabcontent'>
                    <h4 id="noClass"></h4>
                  <table class="u-full-width" id="StudentClasses">
                    <thead>
                    <tr>
                        <th>
                            Course Title
                        </th>
                        <th>
                            Credits
                        </th>
                        <th>
                            Grade
                        </th>
                        <th>
                            Drop
                        </th>
                    </tr>
                    </thead>
                    <?php $count = 0; $cred = 0; ?>
                    <tbody>
                    @if($user)
                        @forelse ($user as $d)
                        <tr>
                            <td>{{$d->title}}</td>
                            <td>{{$d->credits}}</td>
                            <td>{{$d->grade}}</td>
                            <td>
                                {!! Form::open(['action' => 'StudentController@drop', 'method' => 'POST']) !!}
                                <div class="form-group">
                                    {{Form::hidden('uid', session('uid'))}}
                                    {{Form::hidden('section', $d->section)}}
                                    {{Form::submit('Drop', ['class' => 'button-primary'])}}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <?php if ($d->grade != '-'){
                            $count += ($d->weight)*($d->credits); $cred += $d->credits;
                        } ?>
                    @empty
                        <script>
                            try{
                                document.getElementById("StudentClasses").style.display = "none";

                                let toPlace = document.getElementById("noClass");
                                toPlace.innerHTML = "You are not currently enrolled in any classes";

                            }
                            catch(error){
                                //do nothing
                                //console.log(error);
                            }
                        </script>
                    @endforelse
                    @endif
                    <tr>
                        <th>
                            Calculated GPA
                        </th>
                        <td></td>
                        <th>
                            <?php
                            if ($cred == 0) $cred = 1;
                            $gpa = $count/$cred;
                            ?>
                            {{number_format($gpa, 2)}}
                        </th>
                    </tr>
                    </tbody>
                </table>

                </div>
                <div id = 'Enroll' class = 'tabcontent'>
                    <?php

                    $sections = DB::table('course_section')
                        ->select('section_id')
                        ->get();

                    ?>
                    @if($sections)
                        <table class="u-full-width">
                            <thead>
                            <tr>
                                <th> Title</th>

                                <th> Description</th>

                                <th> Section</th>

                                <th> Enroll</th>
                            </tr>
                            </thead>
                            <tbody>
                    @foreach($sections as $sid)
                        <?php
                                $sid = $sid->section_id;
                                $class = DB::table('course_section')
                                    ->join('course','course_section.course_id','=','course.course_id')
                                    ->where('course_section.section_id', $sid)
                                    ->select('title','description')
                                    ->first();
                                ?>
                                <tr>
                                    <td>{{$class->title}}</td>
                                    <td>{{$class->description}}</td>
                                    <td>{{$sid}}</td>
                                    <td>
                    {!! Form::open(['action' => 'StudentController@enroll', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::hidden('section', $sid)}}
                        {{Form::hidden('uid', session('uid'))}}
                        <br/>
                        {{Form::submit('Enroll', ['class' => 'button-primary'])}}
                    </div>
                    {!! Form::close() !!}
                                    </td>
                                </tr>
                    @endforeach

                            </tbody>
                        </table>
                    @endif
                </div>
                <div id = 'Account' class = 'tabcontent'>
                    {!! Form::open(['action' => 'StudentController@personal', 'method' => 'POST', 'class' => 'one-half column']) !!}
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
                    {!! Form::open(['action' => 'StudentController@password', 'method' => 'POST', 'class' => 'one-half column']) !!}
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
