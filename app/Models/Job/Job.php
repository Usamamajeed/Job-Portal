<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    protected $fillable = ['id','job_title','job_region','company','job_type','vacancy','experience','salary','Gender','application_deadline','jobdescription','responsibilities','education_experience','otherbenifits','image','category','created_at','updated_at'];
    public $timestamps = true;
}
