<?php
namespace App\Http\Controllers\Emp;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class JobController extends Controller{


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|numeric',
            'location' => 'required|string|max:255',
            'skills' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {

             return response()->json(['errors' => $validator->errors()], 422);
        }

        Job::class->create([
            'title' => $request->title,
            'description' => $request->description==null?"hello worold":$request->description,
            'salary' => $request->salary,
            'location' => "BTM",
            'skills'=>$request->skills,
            'experience'=>$request->experience,
            'type' => $request->type==null?"programmer":$request->type,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('emp.index')
            ->with('success', 'Job created successfully!');
    }

    public function delete($id){
      $var=  Job::find($id);
      $var->delete();
      return redirect()->route('emp.index');
    }


    public function getJobs(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $perPage = 10; // number of jobs per page
        $page = $request->query('page', 1);

        $jobs = $user->availableJobs()->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'data' => $jobs->items(),
            'current_page' => $jobs->currentPage(),
            'total_pages' => $jobs->lastPage(),
            'total' => $jobs->total(),
        ]);
    }
    public function edit($id)
    {
        $job = Job::find($id);
        if ($job == null) {
            return redirect()->route('emp.index')->withErrors("no such job");
        }
        return View('emp.edit_post', compact('job'));
    }
    public function update($id,Request $request){
        $job=Job::find($id);
        if($job==null){
            return redirect()->route('emp.index')->withErrors("The job you want to update does not exist");
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|numeric',
            'location' => 'required|string|max:255',
            'skills' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


      $update=$job->update([
            'title' => $request->title,
            'description' => $request->description==null?"hello worold":$request->description,
            'salary' => $request->salary,
            'location' => "BTM",
            'skills'=>$request->skills,
            'experience'=>$request->experience,
            'type' => $request->type==null?"programmer":$request->type,
            'user_id' => Auth::id(),
            'qualification' => $request->qualification,
            'updated_at' => now(),
        ]);
        if($update==false){
            return response()->json("Tumse na ho payega");
        }
        return redirect()->route('emp.index');
    }

    public function approveApplication($id){
        $myId=Auth::id();
        $applicant=JobApplication::find($id);
        if($applicant==null){
            return redirect()->route('emp.index')->withErrors("The job you want to update does not exist");
        }
        $jobOwnerId=$applicant->job->user_id;
        if($jobOwnerId!=$myId){
            return redirect()->route('emp.index')->withErrors("You are not authorized approve this application");
        }
        $update=$applicant->update([
            'status' => "accepted",
        ]);
        if($update==false){
           return redirect()->back()->withErrors("Something went wrong");
        }
       return redirect()->back()->with('success',"Application accepted successfully");
    }

    public function rejectApplication($id){
        $myId=Auth::id();
        $applicant=JobApplication::find($id);
        if($applicant==null){
            return redirect()->route('emp.index')->withErrors("The job you want to update does not exist");
        }
        $jobOwnerId=$applicant->job->user_id;
        if($jobOwnerId!=$myId){
            return redirect()->route('emp.index')->withErrors("You are not authorized reject this application");
        }
        $update=$applicant->update([
            'status' => "rejected",
        ]);
        if($update==false){
            return redirect()->back()->withErrors("Something went wrong");
        }
        return redirect()->back()->with('success',"Application rejected successfully");
    }



}
