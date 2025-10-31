<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id','status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

   protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
];

// User.php

public function createRoleProfileIfNeeded()
{
    if ($this->role->name === 'candidate' && !$this->candidate) {
        $this->candidate()->create([
            'name'    => $this->name,
            'resume'  => null,
            'phone'   => null,
            'address' => null,
        ]);
    } elseif ($this->role->name === 'employer' && !$this->employer) {
        $this->employer()->create([
            'name'         => $this->name,
            'company_name' => null,
            'website'      => null,
            'phone'        => null,
            'address'      => null,
        ]);
    }
}



    // Relationships
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function candidate()
    {
        return $this->hasOne(Candidate::class);
    }

    public function employer()
    {
        return $this->hasOne(Employer::class);
    }
    public function notifications()
{
    return $this->hasMany(Notification::class);
}
public function viewedJobs()
{
    return $this->hasMany(JobView::class);
}


}
