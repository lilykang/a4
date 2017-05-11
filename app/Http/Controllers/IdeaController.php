<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idea;
use App\User;
use App\Job;
use Session;

class IdeaController extends Controller
{

    public function index(Request $request) {

        $user = $request->user();
        $allIdeas = Idea::with('jobs')->get();
        $newIdeas = $allIdeas->sortByDesc('created_at')->take(10);

        if($user) {

            $ideas = $user->ideas()->orderBy('idea_name')->get();
        }
        else {
            $ideas = [];
        }

        return view('ideas.index')->with([
            'ideas' => $ideas,
            'newIdeas' => $newIdeas,
        ]);

    }


    public function show($id, Request $request) {

        $idea = Idea::with('jobs')->find($id);

        if(!$idea) {
            Session::flash('message', 'The idea you asked for does not exist.');
            return redirect('/');
        }

        $jobsForThisidea = [];
        foreach($idea->jobs as $job) {
            $jobsForThisidea[] = $job->job_title;
        }

        $description = $idea->description;
        $stage = $idea->stage;
        $user_id = $idea->user_id;
        $creator = User::find($user_id)->name;

        $sessionUserID = null;
        $sessionUser = $request->user();
        if($sessionUser) {
            $sessionUserID = $sessionUser->id;
        }

        return view('ideas.show')->with([
            'idea' => $idea,
            'jobsForThisidea' => $jobsForThisidea,
            'description' => $description,
            'stage' => $stage,
            'creator' => $creator,
            'user_id' => $user_id,
            'sessionUserID' => $sessionUserID
        ]);
    }

    /**
    * Display the form to add a new idea
    */
    public function createNewIdea(Request $request) {

        $jobsForCheckboxes = Job::getJobsForCheckboxes();

        return view('ideas.new')->with([
            'jobsForCheckboxes' => $jobsForCheckboxes
        ]);
    }


    /**
    * POST
    * /ideas/new
    * Process the form for adding a new idea
    */
    public function storeNewIdea(Request $request) {

        $this->validate($request, [
            'idea_name' => 'required',
            'description' => 'required',
            'jobs' => 'required',
        ]);

        # Add new idea to database
        $idea = new Idea();
        $idea->idea_name = $request->idea_name;
        $idea->description = $request->description;
        $idea->stage = $request->stage;
        $idea->user_id = $request->user()->id;
        $idea->save();
        $jobs = ($request->jobs) ?: [];
        $idea->jobs()->sync($jobs);
        $idea->save();

        Session::flash('message', 'Congratulations! '.$request->idea_name.' was shared with your community.');

        # Redirect the user to idea index
        return redirect('/ideas');
    }


    /**
    * GET
    * /ideas/edit/{id}
    * Show form to edit an idea
    */
    public function edit($id) {

        $idea = idea::with('jobs')->find($id);

        if(is_null($idea)) {
            Session::flash('message', 'The idea you requested was not found.');
            return redirect('/ideas');
        }

        $stage = $idea->stage;
        $jobsForCheckboxes = Job::getjobsForCheckboxes();

        # Create an array of just the job titles for jobs associated with this idea
        $jobsForThisidea = [];
        foreach($idea->jobs as $job) {
            $jobsForThisidea[] = $job->job_title;
        }
        # Results in an array like this: $jobsForThisidea => ['Accountant','Web Developer','Researcher'];

        return view('ideas.edit')->with([
            'id' => $id,
            'idea' => $idea,
            'stage' => $stage,
            'jobsForCheckboxes' => $jobsForCheckboxes,
            'jobsForThisidea' => $jobsForThisidea,
        ]);

    }

    /**
    * POST
    * /ideas/edit
    * Process form to save edits to an idea
    */
    public function saveEdits(Request $request) {

        $this->validate($request, [
            'idea_name' => 'required',
            'description' => 'required',
            'jobs' => 'required',
        ]);

        $idea = Idea::find($request->id);

        # Edit idea in the database
        $idea->idea_name = $request->idea_name;
        $idea->description = $request->description;
        $idea->stage = $request->stage;

        # See if there are jobs associated with the edit request
        $jobs = ($request->jobs) ?: [];

        # Sync jobs
        $idea->jobs()->sync($jobs);
        $idea->save();

        Session::flash('message', 'Your changes to '.$idea->idea_name.' were saved.');
        return redirect('/ideas/edit/'.$request->id);

    }


    /**
    * GET
    * Page to confirm deletion
    */
    public function confirmDeletion($id) {

        # Get the idea the user is attempting to delete
        $idea = idea::find($id);

        if(!$idea) {
            Session::flash('message', 'idea not found.');
            return redirect('/ideas');
        }

        return view('ideas.delete')->with('idea', $idea);
    }


    /**
    * POST
    * delete the idea
    */
    public function delete(Request $request) {

        # Get the idea to be deleted
        $idea = idea::find($request->id);

        if(!$idea) {
            Session::flash('message', 'Deletion failed; idea not found.');
            return redirect('/ideas');
        }

        $idea->jobs()->detach();

        $idea->delete();

        # Finish
        Session::flash('message', $idea->idea_name.' was deleted.');
        return redirect('/ideas');
    }

}
