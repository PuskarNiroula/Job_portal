<?php
 namespace App\Http\Controllers\Emp;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmpController extends Controller {
    public function index():View{
        $totalJobs=0;
        if (!empty(Auth::user()->availableJobs)) {
            $totalJobs=Auth::user()->availableJobs->count();
        }
        return view('emp.dashboard',compact('totalJobs'));
    }
    public function PostJob():View{
        return view('emp.post_job');
    }
    public function viewApplication($id){
        $applicants = JobApplication::where('post_id',$id)->with([
            'user:id,name',
            'user.jobSeekerProfile:user_id,experience,qualification'
        ])->get();
        if(Auth::id()!=$applicants[0]->job->user_id)
            return redirect()->route("dashboard")->with('error','Unauthorized');

        return view('emp.view_application',compact('applicants'));
    }
}
