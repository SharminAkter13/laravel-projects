<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = [
        'username',
        'email',
        'first_name',
        'last_name',
        'address',
        'city',
        'country',
        'postal_code',
        'about_me',
        'age',
        'job_title',
        'location',
        'education',
        'user_id', // important for the relationship
    ];

    /**
     * The user that owns the profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
