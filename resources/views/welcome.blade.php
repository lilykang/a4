@extends('layouts.master')

@push('head')
    <link href='/css/ideas.css' rel='stylesheet'>
    <link href='/css/welcome.css' rel='stylesheet'>
@endpush

@section('title')
    Ideas Hub
@endsection

@section('content')

	<h1>Welcome!</h1>
    <p>Welcome to Ideas Hub, the central place of startup ideas from your community.</p>
    <p>To get started <a href='/login'>login</a> or <a href='/register'>register</a>.</p>
    <p>Demo login: jill@harvard.edu | helloworld  or jamal@harvard.edu | helloworld</p>

@endsection
