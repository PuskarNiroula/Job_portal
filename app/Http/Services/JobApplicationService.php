<?php

namespace App\Http\Services;

use App\Models\JobApplication;

class JobApplicationService{

    public function getJobApplicationsByPostId(int $postId){
        $applications=JobApplication::where('post_id',$postId)->get();
        if($applications->count()==0){
            return null;
        }
        return $applications;
    }

}
