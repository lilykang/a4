@extends('layouts.master')

@push('head')
    <link href='/css/ideas.css' rel='stylesheet'>
@endpush

@section('title')
    Ideas
@endsection

@section('content')

    @if(count($ideas) > 0)
        <section id='ideas' class='cf'>

            <h2>Your Ideas</h2>

            @foreach($ideas as $idea)
                <a href='/ideas/{{ $idea->id }}'><h3>{{ $idea->idea_name }}</h3></a>
                <a class='ideaAction' href='/ideas/edit/{{ $idea->id }}'><i class='fa fa-pencil'></i></a>
                <a class='ideaAction' href='/ideas/{{ $idea->id }}'><i class='fa fa-eye'></i></a>
                <a class='ideaAction' href='/ideas/delete/{{ $idea->id }}'><i class='fa fa-trash'></i></a>
            @endforeach

        </section>
    @else
        <h3>Ideas Hub is the center of startup ideas from you community.<br>
        You can share your ideas and view those posted by others. <br></h3>

        <h4>Would you like to <a href='/ideas/new'>share an idea with your community</a>?</h4>
        <br>

    @endif


    @if(count($newIdeas) > 0)
    <section id='newIdeas' class='cf'>

        <h3>Ideas from Your Community</h3>

        @foreach($newIdeas as $idea)
            
            <a href='/ideas/{{ $idea->id }}'>{{ $idea->idea_name }}</a>
            added {{ $idea->created_at->diffForHumans()}}

        @endforeach

    </section>
    @else
        Your community hasn't posted any idea yet! <a href='/ideas/new'>Why don't you get it started</a>?
    @endif

@endsection
