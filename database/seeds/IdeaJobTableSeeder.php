<?php

use Illuminate\Database\Seeder;
use App\Idea;
use App\Job;

class IdeaJobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Create an array of all the ideas to associate jobs with
        # The keys are the idea names, and the values are be an array of jobs
        $ideas =[
            'iPhone 9' => ['Financial Analyst', 'Graphic Designer', 'Accountant'],
            'VR Headset' => ['Marketer', 'Researcher', 'PR Coordinator'],
            'IoT Device' => ['Accountant', 'Web Developer'],
            'AR GPS' => ['Researcher','Accountant','Graphic Designer']
        ];


        # Loop through the above array, creating a new pivot for each idea to job
        foreach($ideas as $idea_name => $jobs) {

            # Get the idea
            $idea = Idea::where('idea_name','like',$idea_name)->first();

            # Loop through each job for this idea to add the pivot table
            foreach($jobs as $jobTitle) {
                $job = Job::where('job_title','LIKE',$jobTitle)->first();

                # Connect this job to this idea
                $idea->jobs()->save($job);
            }

        }
    }
}
