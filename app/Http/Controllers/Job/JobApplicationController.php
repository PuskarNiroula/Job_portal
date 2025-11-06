<?php

namespace App\Http\Controllers\Job;
use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller{

    public function apply(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->post_id;

        // Check if the user already applied
        if (JobApplication::where('post_id', $post_id)->where('user_id', $user_id)->exists()) {
            return response()->json([
                'message' => 'You have already applied for this job'
            ], 400);
        }

//
       JobApplication::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
            "resume"=>"hello",
        ]);


            return response()->json([
                'status' => 'success',
                'message' => 'Application sent'
            ]);



    }
}
