<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Job\Application;
use App\Models\Job\Job;
use App\Models\Job\JobSaved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobsController extends Controller
{
    public function single($id)
    {
        $job = Job::find($id);

        //getting realted jobs
        $relatedJobs =  Job::where('category',$job->category)->where('id', '!=', $id)->take(5)->get();
        $relatedJobsCount =  Job::where('category',$job->category)->where('id', '!=', $id)->take(5)->count();

        //Save Job
        $savedJob = JobSaved::where('job_id',$id)->where('user_id',Auth::user()->id)->count();
        return view('jobs.single',compact('job', 'relatedJobs', 'relatedJobsCount', 'savedJob'));


    }

    public function savejob(Request $request)
    {
        $savejob = JobSaved::create([
            'job_id'      => $request->job_id,
            'user_id'     => $request->user_id,
            'job_image'   => $request->job_image,
            'job_title'   => $request->job_title,
            'job_region'  => $request->job_region,
            'job_type'    => $request->job_type,
            'company'     => $request->company,
        ]);

        if ($savejob) {
            return redirect('/jobs/single/'.$request->job_id.'')->with('save', 'job saved successfully');
        }

    }

    public function jobApply(Request $request)
    {
        if ($request->cv == 'No cv') {
            return redirect('/jobs/single/'.$request->job_id.'')->with('apply', 'Upload Your CV First In The Profile Page');
        } else {
            $applyJob = Application::create([
                'cv'          => Auth::user()->cv,
                'job_id'      => $request->job_id,
                'user_id'     => Auth::user()->id,
                'job_image'   => $request->job_image,
                'job_title'   => $request->job_title,
                'job_region'  => $request->job_region,
                'job_type'    => $request->job_type,
                'company'     => $request->company,
            ]);

            if ($applyJob) {
                return redirect('/jobs/single/'.$request->job_id.'')->with('applied', 'You Applied To This Job successfully');
            }
        }




    }
}
