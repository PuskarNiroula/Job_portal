<?php
namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Services\JobService;
use App\Models\Job;
use App\Models\JobSeekerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\search;

class JobSeekerController extends Controller {

    public function index(){
        return view('job.dashboard');
    }

    public function getJobs(Request $request){

            $jobs = Job::with('user')
                ->latest()
                ->paginate(6);
            return response()->json($jobs);
    }
    public function completeProfile(){
        $profile=JobSeekerProfile::where('user_id',Auth::id())->first();
        if ($profile && $profile->user) {
            $profile->setRelation('user', collect($profile->user)->only([
                'id', 'name', 'email', 'phone', 'image'
            ]));
        }
        return view('job.profile',compact('profile'));
    }
    public function search(Request $request){
       $searchTerm=(string) $request->query('search');
       $service=new JobService();
       $jobs=$service->search($searchTerm);
       return response()->json($jobs);
    }

}
