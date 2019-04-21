@extends('layouts.app')

@section('content')
<div class="centered">
    <h4>SIS Login</h4>
    {!! Form::open(['action' => 'LoginsController@verify', 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('username', 'Username')}}
        {{Form::text('username', '', ['class' => 'u-full-width', 'placeholder' => 'xyz1234', 'required'])}}
        {{Form::label('password', 'Password')}}
        {{Form::password('password', ['class' => 'u-full-width', 'placeholder' => 'password', 'required'])}}<br>
        {{Form::submit('Submit', ['class' => 'button-primary'])}}
    </div>
    {!! Form::close() !!}
</div>
@endsection
