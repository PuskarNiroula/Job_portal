<?php
namespace App\Http\Services;
use App\Models\Job;

class JobService{

    public function search(string $searchTerm){
        $jobs=Job::where('title','like','%'.$searchTerm.'%')->orWhere('skills','like','%'.$searchTerm."%")->orWhere('qualification','like','%'.$searchTerm."%")->with('user:id,name')->get();
        return $jobs;
    }

}
