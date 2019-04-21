@if (session('role') == 1)
    @extends('layouts.app')
    @section('content')
        <div class="row"><h4>{{ session('name') }}</h4></div>
        <div class="row">
            <div class="tab">
                <button class="tablinks active" onclick="openCity(event, 'Courses')">Courses</button>
                <button class="tablinks" onclick="openCity(event, 'Grading')">Class List</button>
                <button class="tablinks" onclick="openCity(event, 'Account')">Account</button>
            </div>
            <div id = 'Courses' class = 'tabcontent'>
                <table class="u-full-width" id="Table">
                    <thead>
                    <tr>
                        <th>
                            Course Title
                        </th>
                        <th>
                            Section Number
                        </th>
                    </tr>
                    </thead>
                    <?php $count = 0; $cred = 0; ?>
                    <tbody>
                    @if(session('det'))
                        @forelse (session('det') as $d)
                            <tr>
                                <td>{{$d->title}}</td>
                                <td>{{$d->section}}</td>
                            </tr>
                        @empty
                            <script>
                                try{
                                    document.getElementById("Table").style.display = "none";

                                    let toPlace = document.getElementById("empty");
                                    toPlace.innerHTML = "You are not currently teaching any classes.";

                                }
                                catch(error){
                                    //do nothing
                                    //console.log(error);
                                }
                            </script>
                        @endforelse
                    @endif
                    </tbody>
                </table>
            </div>
            <div id="Grading" class="tabcontent">
                <?php \App\Http\Controllers\FacultyController::classList() ?>

                @if(session('class_list'))
                    <?php $map = session('map'); ?>
                    @forelse(session('class_list') as $sid=>$cl)

                        <div class="one-third column">
                            <h5>{{$sid. " " . $map[$sid]}}</h5>
                            <table class="u-full-width">
                                <thead>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Grade
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($cl as $stu)
                                    <?php
                                    $name = $stu->name;
                                    $uid = $stu->uid;
                                    ?>
                                    <tr>
                                        <td>{{$name}}</td>
                                        <td>

                                            {!! Form::open(['action' => 'FacultyController@updateGrade', 'method' => 'POST', 'class' => 'u-full-width']) !!}
                                            <div class="form-group">
                                                {{Form::hidden('uid', $uid)}}
                                                {{Form::hidden('section_id', $sid)}}
                                                {{Form::select('grade', ['A'=>'A', 'A-'=>'A-', 'B+'=>'B+', 'B'=>'B', 'B-'=>'B-', 'C+'=>'C+', 'C'=>'C', 'C-'=>'C-', 'D'=>'D', 'F'=>'F'], null, ['class' => 'u-full-width', 'placeholder' => '-'])}}
                                                {{Form::submit('Update Grade', ['class' => 'button-primary'])}}
                                            </div>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <script>
                                        try{
                                            document.getElementById("Table").style.display = "none";

                                            let toPlace = document.getElementById("empty");
                                            toPlace.innerHTML = "You are not currently teaching any classes.";
                                        }
                                        catch(error){
                                            //do nothing
                                            //console.log(error);
                                        }
                                    </script>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        @empty
                            <script>
                                try{
                                    document.getElementById("Table").style.display = "none";

                                    let toPlace = document.getElementById("empty");

                                }
                                catch(error){
                                    //do nothing
                                    //console.log(error);
                                }
                            </script>
                    @endforelse
                @endif
            </div>
            <div id = 'Account' class = 'tabcontent'>
                {!! Form::open(['action' => 'FacultyController@personal', 'method' => 'POST']) !!}
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
                    {{Form::submit('Update Personal Details', ['class' => 'button-primary'])}}
                </div>
                {!! Form::close() !!}
                {!! Form::open(['action' => 'FacultyController@password', 'method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label('password', 'New Password')}}
                    {{Form::password('password')}}
                    <br/>
                    {{Form::submit('Update Password', ['class' => 'button-primary'])}}
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
