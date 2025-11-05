<?php

namespace App\Http\Controllers\Job;
use App\Http\Controllers\Controller;
use App\Models\JobSeekerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JobSeekerProfileController extends Controller
{
    public function index(){
        $profile=JobSeekerProfile::where('user_id',Auth::id())->first();
        return view('job.view_profile',compact('profile'));
    }

    public function edit(Request $request){
        $valid=Validator::make($request->all(),[
            'address'=>'string',
            'qualification'=>'string',
            'experience'=>'string',
            'cv'=>"file|mimes:pdf|max:3500"
        ]);
        if($valid->fails()){
            return redirect()->back()->withErrors($valid);
        }
        $profile = JobSeekerProfile::where('user_id', Auth::id())->first();
        $path=null;
        if($request->hasFile('cv')){
            $file = $request->file('cv');
            $filename = Auth::id() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('cvs', $filename, 'public');
            $profile->cv = $path;
        }


        if($profile==null) {
            JobSeekerProfile::create([
                'user_id' => Auth::id(),
                'address' => $request->address,
                'qualification' => $request->qualification,
                'experience' => $request->experience,
                'cv' => $path,
            ]);
        }
            else{
                if($profile->cv!=null) {
                    Storage::disk('public')->delete($profile->cv);
                }
                $profile->address=$request->address;
                $profile->qualification=$request->qualification;
                $profile->experience=$request->experience;
                if($request->hasFile('cv')){
                    $profile->cv=$path;
                }
                $profile->save();
            }
            return redirect()->route('/dashboard');
        }


}
