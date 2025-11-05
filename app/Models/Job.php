<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table="available_jobs";
    protected $primaryKey="job_id";
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
