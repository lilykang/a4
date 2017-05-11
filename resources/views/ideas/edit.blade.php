{{-- /resources/views/ideas/new.blade.php --}}
@extends('layouts.master')

@section('title')
    Edit idea: {{ $idea->idea_name }}
@endsection

@push('head')
    <link href='/css/ideas.css' rel='stylesheet'>
@endpush

@section('content')
    <h1>Edit</h1>
    <h2>{{ $idea->idea_name }}</h2>

    <form method='POST' action='/ideas/edit'>
        {{ csrf_field() }}

        <p>* Required fields</p>

        <input type='hidden' name='id' value='{{$idea->id}}'>

        <label for='idea_name'>* Idea Name</label>
        <input type='text' name='idea_name' id='idea_name' value='{{ old('idea_name', $idea->idea_name) }}'>

        <label for='description'>* Describe Your Idea</label>
        <input type='text' name='description' id='description' value='{{ old('description', $idea->description) }}'>


        <label>Which stage is your idea in?</label>
        <ul id='stage'>
            <label for='stage'>
                {{ Form::radio('stage', 'Ideating', $stage == 'Ideating' ? 'True' : null) }} Ideating <br>
                {{ Form::radio('stage', 'Concepting', $stage == 'Concepting' ? 'True' : null) }} Concepting <br>
                {{ Form::radio('stage', 'Committing', $stage == 'Committing' ? 'True' : null) }} Committing <br>
                {{ Form::radio('stage', 'Validating', $stage == 'Validating' ? 'True' : null) }} Validating <br>
                {{ Form::radio('stage', 'Scaling', $stage == 'Scaling' ? 'True' : null) }} Scaling <br>
                {{ Form::radio('stage', 'Establishing', $stage == 'Establishing' ? 'True' : null) }} Establishing <br>
            </label>
        </ul>


        <label for='jobs'>* Jobs</label>
        <ul id='jobs'>
            @foreach($jobsForCheckboxes as $id => $job_title)
                <li><input
                    type='checkbox'
                    value='{{ $id }}'
                    id='job_{{ $id }}'
                    name='jobs[]'
                    {{ (in_array($job_title, $jobsForThisidea)) ? 'CHECKED' : '' }}
                >&nbsp;
                <label for='job_{{ $id }}'>{{ $job_title }}</label></li>
            @endforeach
        </ul>

        {{-- Extracted error code to its own view file --}}
        @include('errors')

        <br><input class='btn btn-primary' type='submit' value='Save changes'><br><br>

    </form>



@endsection
