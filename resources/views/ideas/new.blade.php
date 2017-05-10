{{-- /resources/views/ideas/new.blade.php --}}
@extends('layouts.master')

@section('title')
    New Idea
@endsection

@push('head')
    <link href='/css/ideas.css' rel='stylesheet'>
@endpush


@section('content')
    <h1>Share Your Idea</h1>

    <form method='POST' action='/ideas/new'>
        {{ csrf_field() }}

        <small>* Required fields</small>
        <label for='idea_name'>* Give Your Idea a Name:</label>
        <input type='text' name='idea_name' required id='idea_name' value='{{ $idea_name or '' }}'>

        <label for='description'>* Describe Your Idea:</label>
        <input type='text' name='description' maxlength="3000" required id='description'
            value='{{ $description or '' }}'>

        <label for='stage'>Which stage is your idea in?</label>
        <ul id='stage'>
            <label for='stage'>
                {{ Form::radio('stage', 'Ideating', 'true') }} Ideating <br>
                {{ Form::radio('stage', 'Concepting') }} Concepting <br>
                {{ Form::radio('stage', 'Committing') }} Committing <br>
                {{ Form::radio('stage', 'Validating') }} Validating <br>
                {{ Form::radio('stage', 'Scaling') }} Scaling <br>
                {{ Form::radio('stage', 'Establishing') }} Establishing <br>
            </label>
        </ul>

        <label>* Job Needs</label>
        <ul id='jobs'>
            @foreach($jobsForCheckboxes as $id => $job_title)
                <li><input
                    type='checkbox'
                    value='{{ $id }}'
                    id='job_{{ $id }}'
                    name='jobs[]'
                >&nbsp;
                <label for='job_{{ $id }}'>{{ $job_title }}</label></li>
            @endforeach
        </ul>

        {{-- Extracted error code to its own view file --}}
        @include('errors')

        <input class='btn btn-primary' type='submit' value='Share My Idea'>
    </form>

@endsection
