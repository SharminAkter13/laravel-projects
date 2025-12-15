<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Candidate;


class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'candidate_id',
        'applied_date',
        'status',
        'resume', 
        'cover_letter',
    ];

    // Relationships

    public function job()
    {
        return $this->belongsTo(Job::class);
    }


   public function candidate()
{
    return $this->belongsTo(Candidate::class, 'candidate_id');
}


    
}
