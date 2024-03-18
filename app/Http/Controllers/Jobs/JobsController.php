<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Job\Job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function single($id)
    {
        $job = Job::find($id);

        //getting realted jobs
        $relatedJobs =  Job::where('category',$job->category)->where('id', '!=', $id)->take(5)->get();
        $relatedJobsCount =  Job::where('category',$job->category)->where('id', '!=', $id)->take(5)->count();

        return view('jobs.single',compact('job', 'relatedJobs', 'relatedJobsCount'));


    }
}
