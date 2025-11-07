<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $table="job_applications";
    protected $primaryKey="id";
    protected $guarded=[];
    public $timestamps=false;

    public function job(){
        return $this->belongsTo(Job::class,'post_id','job_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
