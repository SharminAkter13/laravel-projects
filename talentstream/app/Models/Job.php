<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Job extends Model
{
    protected $fillable = [
        'user_email','employer_id', 'title', 'location', 'category_id', 'tags',
        'description', 'application_email', 'application_url',
        'closing_date', 'company_name', 'website', 'tagline',
        'cover_image', 'status'
    ];

    protected $casts = [
        'closing_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function viewers()
{
    return $this->hasMany(JobView::class);
}
public function employers()
{
    return $this->belongsTo(Employer::class);
}
   public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }

}
