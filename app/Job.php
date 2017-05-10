<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function ideas() {
        return $this->belongsToMany('App\Idea')->withTimestamps();
    }

    public static function getJobsForCheckboxes() {

        $jobs = Job::orderBy('job_title','ASC')->get();

        $jobsForCheckboxes = [];

        foreach($jobs as $job) {
            $jobsForCheckboxes[$job['id']] = $job->job_title;
        }

        return $jobsForCheckboxes;

    }
}
