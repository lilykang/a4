@extends('layouts.master')

@push('head')
    <link href='/css/ideas.css' rel='stylesheet'>
@endpush

@section('title')
    {{ $idea->idea_name }}
@endsection

@section('content')

    <div class='idea cf'>

        <h1>{{ $idea->idea_name }}</h1>

        <p>Description: {{ $description}}</p>

        <p>Jobs available:</p>
        <ul>
            @foreach ($jobsForThisidea as $job_title)
                <li>{{ $job_title }}<br></li>
            @endforeach
        </ul>

        <p>Stage of idea: {{ $stage }}</p>

        <p>Creator: {{ $creator }}</p>

        <p>Published: {{ $idea->created_at }}</p>

        <p>Last updated: {{ $idea->updated_at }}</p>

        @if ($sessionUserID == $user_id)
            <a class='ideaAction' href='/ideas/edit/{{ $idea->id }}'><i class='fa fa-pencil'></i></a>
            <a class='ideaAction' href='/ideas/{{ $idea->id }}/delete'><i class='fa fa-trash'></i></a>
        @endif

    </div>
@endsection
