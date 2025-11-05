<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobSeekerProfile extends Model
{
    protected $table="job_seeker_profiles";
    protected $guarded=[];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
