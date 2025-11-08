<?php
 namespace App\Http\Controllers\Emp;

use App\Http\Controllers\Controller;
use App\Http\Services\JobApplicationService;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmpController extends Controller {
    private JobApplicationService $jobApplicationService;

    public function __construct(){
        $this->jobApplicationService= new JobApplicationService();
    }
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
        $job =Job::class->find($id);
        if($job==null || $job->user->id!==Auth::id()){
            return redirect()->route("dashboard")->with('error','Unauthorized');
        }
        $applicants = $this->jobApplicationService->getJobApplicationsByPostId($id);

        return view('emp.view_application',compact('applicants'));
    }
}
