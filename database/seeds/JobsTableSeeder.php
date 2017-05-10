<?php

use Illuminate\Database\Seeder;
use App\Job;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = ['Financial Analyst', 'Graphic Designer', 'Accountant', 'Web Developer',
            'Marketer', 'Researcher', 'PR Coordinator'];

        foreach($jobs as $jobTitle) {
            $job = new Job();
            $job->job_title = $jobTitle;
            $job->save();
        }
    }
}
