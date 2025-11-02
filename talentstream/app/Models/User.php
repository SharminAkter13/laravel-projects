<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Automatically create profiles based on user role
    protected static function booted()
    {
        static::created(function ($user) {
            $user->createRoleProfileIfNeeded();
        });
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

    // Check if the user has a certain role
    public function isRole($roleName)
    {
        return $this->role ? $this->role->name === $roleName : false;
    }

    // Determine which dashboard route the user should go to
    public function dashboardRoute()
    {
        return match($this->role->name) {
            'admin' => route('admin.dashboard'),
            'candidate' => route('candidate.dashboard'),
            'employer' => route('employer.dashboard'),
            default => route('login'), // fallback if no role matched
        };
    }

    // Create role-specific profiles if not already created
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
}
