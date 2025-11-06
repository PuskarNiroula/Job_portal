<?php

namespace App\Http\Controllers\Job;
use App\Http\Controllers\Controller;
use App\Models\JobSeekerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JobSeekerProfileController extends Controller
{
    public function index(){
        $profile=JobSeekerProfile::where('user_id',Auth::id())->first();
        return view('job.view_profile',compact('profile'));
    }

    public function edit(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'digits_between:8,15|nullable', // ✅ good for phone numbers
            'address' => 'string|nullable',   // add nullable, otherwise empty string may fail
            'qualification' => 'string|nullable',
            'experience' => 'string|nullable',
            'image' => 'file|mimes:jpeg,png,jpg,gif,svg|max:3500|nullable', // add nullable
            'cv' => 'file|mimes:pdf|max:3500|nullable',                       // add nullable
        ]);
        if($valid->fails()){
            return redirect()->back()->withErrors($valid);
        }
        DB::beginTransaction();
        $user=Auth::user();
        $user->name=$request->name;
        $user->phone=$request->phone?:null;
        if($request->hasFile('image')){
            if ($user->image != null) {
                Storage::disk('public')->delete($user->image);
            }
            $file = $request->file('image');
            $filename = Auth::id() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Images', $filename, 'public');
            $user->image = $path;
        }
        $user->save();

        $profile = JobSeekerProfile::where('user_id', Auth::id())->first();
        $path=null;
        if($request->hasFile('cv')){
            $file = $request->file('cv');
            $filename = Auth::id() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('cvs', $filename, 'public');
        }


        if ($profile == null) {
            JobSeekerProfile::create([
                'user_id' => Auth::id(),
                'address' => $request->address,
                'qualification' => $request->qualification,
                'experience' => $request->experience,
                'cv' => $path,
            ]);
        } else {
            $profile->address = $request->address;
            $profile->qualification = $request->qualification;
            $profile->experience = $request->experience;
            if ($request->hasFile('cv')) {
                if ($profile->cv != null) {
                    Storage::disk('public')->delete($profile->cv);
                }
                $profile->cv = $path;
            }
            $profile->save();
        }

        DB::commit();
            return redirect()->route('dashboard');
        }
        public function view(){
//        $profile=JobSeekerProfile::where('user_id',Auth::id())->first();
            $profile = JobSeekerProfile::with(['user:id,name,email,phone,image'])
                        ->where('user_id', Auth::id())
                        ->first();
        return view('job.view_profile',compact('profile'));
        }


}
