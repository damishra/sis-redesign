@extends('layouts.app')

@section('title', 'Welcome')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
        <h1>This is just a fancy Welcome page!</h1><br>
        <h3>Login right <a href="{{url('auth/login')}}">this</a> way...</h3>
@endsection
