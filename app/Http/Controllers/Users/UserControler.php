<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Job\Application;
use App\Models\Job\JobSaved;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserControler extends Controller
{
    public function profile()
    {
        $profile = User::find(Auth::user()->id);
        return view('users.profile', compact('profile'));
    }

    public function applications()
    {
        $applications = Application::where('user_id', '=', Auth::user()->id)->get();
        return view('users.applications', compact('applications'));
    }

    public function savedJobs()
    {
        $savedJobs = JobSaved::where('user_id', '=', Auth::user()->id)->get();
        return view('users.savedjobs', compact('savedJobs'));
    }

    //This Function will show the details of user
    public function editDetails()
    {
        $userDetails = User::find(Auth::user()->id);
        return view('users.editdetails', compact('userDetails'));
    }

    //This Function will Update the details of user
    public function updateDetails(Request $request)
    {
        //Validate Input Fields So It can't be null
        Request()->validate([
            "name" => "required|max:40", //Required and can be 40 chrachters max
            "job_title" => "required|max:40",
            "bio" => "required", //Required and no length described
            "facebook" => "required|max:140",
            "twitter" => "required|max:140",
            "linkedin" => "required|max:140",
        ]);


        $userDetailsUpdate = User::find(Auth::user()->id);
        $userDetailsUpdate->update([
            "name" => $request->name,
            "job_title" => $request->job_title,
            "bio" => $request->bio,
            "facebook" => $request->facebook,
            "twitter" => $request->twitter,
            "linkedin" => $request->linkedin,
        ]);
        if ($userDetailsUpdate) {
            return redirect('/users/edit-details/')->with('update', 'User Deatils Updated Sucessfully');
        }
    }

    public function showCV()
    {
        return view('users.editcv');
    }

    public function updateCV(Request $request)
    {
        Request()->validate([
            "cv" => "required"
        ]);
        //Before updating the CV, Delete the previous
        $oldCV = User::find(Auth::user()->id);
        $file_path = public_path('assets/cvs/'.$oldCV->cv);
        unlink($file_path);


        //Update the CV
        $detinationPath = 'assets/cvs';
        $myCV = $request->cv->getClientOriginalName();
        $request->cv->move(public_path($detinationPath), $myCV);
        $oldCV->update([
            'cv' => $myCV
        ]);

        if ($oldCV) {
            return redirect('/users/profile/')->with('update', 'CV Updated Sucessfully');
        }
    }

    public function showImage()
    {
        return view('users.edit_profile_image');
    }

    public function updateImage(Request $request)
    {
        Request()->validate([
            "user_image" => "required"
        ]);
        //Before updating the User Image, Delete the previous
        $oldImage = User::find(Auth::user()->id);
        $image_path = public_path('assets/images_users/'.$oldImage->image);
        unlink($image_path);


        //Update the Image
        $detinationPath = 'assets/images_users';
        $myImage = $request->user_image->getClientOriginalName();
        $request->user_image->move(public_path($detinationPath), $myImage);
        $oldImage->update([
            'image' => $myImage
        ]);

        if ($myImage) {
            return redirect('/users/profile/')->with('image_update', 'Image Updated Sucessfully');
        }
    }
}

