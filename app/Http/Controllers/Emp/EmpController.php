<?php
 namespace App\Http\Controllers\Emp;

use App\Http\Controllers\Controller;
use App\Models\Job;
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
}
