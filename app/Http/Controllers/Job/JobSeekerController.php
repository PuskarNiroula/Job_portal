<?php
namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobSeekerController extends Controller {

    public function getJobs(Request $request){

            $jobs = Job::with('user')
                ->latest()
                ->paginate(6);
            return response()->json($jobs);
    }
    public function completeProfile(){
        return view('job.profile');
    }

}
