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
            default => route('login'),
        };
    }

    // Create role-specific profiles if not already created
    public function createRoleProfileIfNeeded()
    {
        if ($this->role->name === 'candidate' && !$this->candidate) {
            $this->candidate()->create([
                'resume'  => null,
                'phone'   => null,
                'address' => null,
            ]);
        } elseif ($this->role->name === 'employer' && !$this->employer) {
            $this->employer()->create([
                'company_name' => null,
                'website'      => null,
                'phone'        => null,
                'address'      => null,
            ]);
        }
    }

    // Messages relationships using conversations
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function conversations()
    {
        return Conversation::where('user_one', $this->id)
            ->orWhere('user_two', $this->id)
            ->get();
    }

    // Get all messages received by this user (through conversations)
    public function receivedMessages()
    {
        $userId = $this->id;

        return Message::whereHas('conversation', function ($q) use ($userId) {
            $q->where('user_one', $userId)
              ->orWhere('user_two', $userId);
        })
        ->where('sender_id', '!=', $userId);
    }
}
