@extends('layouts.master')

@section('title')
    Confirm deletion: {{ $idea->idea_name }}
@endsection

@section('content')

    <h1>Confirm deletion</h1>
    <form method='POST' action='/ideas/delete'>

        {{ csrf_field() }}

        <input type='hidden' name='id' value='{{ $idea->id }}'?>

        <h2>Are you sure you want to delete <em>{{ $idea->idea_name }}</em>?</h2>

        <input type='submit' value='Yes, delete this idea.' class='btn btn-danger'>

    </form>

@endsection
