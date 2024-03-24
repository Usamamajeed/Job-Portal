<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Category\Category;
use App\Models\Job\Application;
use App\Models\Job\Job;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function viewLogin()
    {
        return view("admins.view-login");
    }

    public function checkLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function index()
    {
        $jobs = Job::select()->count();
        $categories = Category::select()->count();
        $admins = Admin::select()->count();
        $applications = Application::select()->count();
        return view("admins.index", compact('jobs', 'categories', 'admins', 'applications'));
    }

    public function admins()
    {
        $admins = Admin::all();
        return view("admins.all-admins", compact('admins'));
    }

    public function createAdmins()
    {

        return view("admins.create-admins");
    }

    public function storeAdmins(Request $request)
    {
        Request()->validate([
            "name" => "required|max:40", //Required and can be 40 chrachters max
            "email" => "required|max:40",
            "password" => "required", //Required and no length described
        ]);

        $createAdmins =  Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($createAdmins) {
            return redirect('admin/all-admins/')->with('create', 'Admin Created Sucessfully');
        }
    }

    //Categoreis
    public function displayCategories()
    {
        $categories = Category::all();
        return view("admins.display-categories", compact('categories'));
    }

    public function createCategories()
    {

        return view("admins.create-categories");
    }

    public function storeCategories(Request $request)
    {
        Request()->validate([
            "name" => "required|max:40", //Required and can be 40 chrachters max
        ]);

        $createCateories =  Category::create([
            'name' => $request->name,
        ]);

        if ($createCateories) {
            return redirect('admin/display-categories/')->with('create', 'Category Created Sucessfully');
        }
    }

    public function editCategories($id)
    {
        $category = Category::find($id);
        return view("admins.edit-categories", compact('category'));
    }

    public function updateCategories(Request $request, $id)
    {
        Request()->validate([
            "name" => "required|max:40", //Required and can be 40 chrachters max
        ]);

        $updateCategory = Category::find($id);
        $updateCategory->update([
           "name" => $request->name,
        ]);

        if ($updateCategory) {
            return redirect('admin/display-categories/')->with('update', 'Category Updates Sucessfully');
        }
    }

    public function deleteCategories($id)
    {
        $deleteCategory = Category::find($id);
        $deleteCategory->delete();
        if ($deleteCategory) {
            return redirect('admin/display-categories/')->with('delete', 'Category Deleted Sucessfully');
        }
    }

    //Jobs
    public function allJobs()
    {
        $jobs = Job::all();
        return view("admins.all-jobs", compact('jobs'));
    }

    public function createJobs()
    {
        $categories = Category::all();
        return view("admins.create-jobs", compact('categories'));
    }

    public function storeJobs(Request $request)
    {
        Request()->validate([
            "job_title" => "required",
            "job_region" => "required",
            "company" => "required",
            "job_type" => "required",
            "vacancy" => "required",
            "experience" => "required",
            "salary" => "required",
            "gender" => "required",
            "application_deadline" => "required",
            "job_description" => "required",
            "responsibilities" => "required",
            "education_experience" => "required",
            "other_benifits" => "required",
            "categroy" => "required",
            "image" => "required",
        ]);

        $detinationPath = 'assets/images';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($detinationPath), $myimage);

        $createJobs =  Job::create([
            'job_title' => $request->job_title,
            'job_region' => $request->job_region,
            'company' => $request->company,
            'job_type' => $request->job_type,
            'vacancy' => $request->vacancy,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'Gender' => $request->gender,
            'application_deadline' => $request->application_deadline,
            'jobdescription' => $request->job_description,
            'responsibilities' => $request->responsibilities,
            'education_experience' => $request->education_experience,
            'otherbenifits' => $request->other_benifits,
            'category' => $request->categroy,
            'image' => $myimage,
        ]);

        if ($createJobs) {
            return redirect('admin/display-jobs/')->with('create', 'Job Created Sucessfully');
        }
    }

    public function deleteJobs($id)
    {
        $deletejob = Job::find($id);
        if (File::exists(public_path('assets/images/'. $deletejob->image))) {
            File::delete(public_path('assets/images/'. $deletejob->image));
        }
        $deletejob->delete();
        if ($deletejob) {
            return redirect('admin/display-jobs/')->with('delete', 'Job Deleted Sucessfully');
        }
    }




}
