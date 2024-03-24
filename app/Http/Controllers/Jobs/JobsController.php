<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Job\Application;
use App\Models\Job\Job;
use App\Models\Job\JobSaved;
use App\Models\Job\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Collection;

class JobsController extends Controller
{
    public function single($id)
    {
        $job = Job::find($id);

        //getting realted jobs
        $relatedJobs =  Job::where('category',$job->category)->where('id', '!=', $id)->take(5)->get();

        $relatedJobsCount =  Job::where('category',$job->category)->where('id', '!=', $id)->take(5)->count();

        //Show All Categories
        $categories = Category::all();

        if (auth()->user()) {
            //Save Job
            $savedJob = JobSaved::where('job_id',$id)->where('user_id',Auth::user()->id)->count();


            //verifying if user  applied  to job already
            $appliedJob = Application::where('user_id', Auth::user()->id)->where('job_id',$id)->count();

            return view('jobs.single',compact('job', 'relatedJobs', 'relatedJobsCount', 'savedJob', 'appliedJob', 'categories'));
        } else {
            return view('jobs.single',compact('job', 'relatedJobs', 'relatedJobsCount', 'categories'));
        }


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
        if (Auth::user()->cv == 'No cv') {
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

    public function search(Request $request)
    {
        if ($request->job_title) {
            Search::create([
                "keyword" => $request->job_title
            ]);
        }


        $job_title = $request->get('job_title');
        $job_region = $request->get('job_region');
        $job_type = $request->get('job_type');
        $searches = collect([]);
        $query = Job::query()->select();

        if($job_title ||$job_region || $job_type) {
            if ($job_title) {
                $query->where('job_title', 'like', "%$job_title%");
            }
            if ($job_region) {
                $query->where('job_region', 'like', "%$job_region%");
            }
            if ($job_type) {
                $query->where('job_type', 'like', "%$job_type%");
            }
            $searches = $query->get();
        }
        return view('jobs.search', compact('searches'));
    }
}
