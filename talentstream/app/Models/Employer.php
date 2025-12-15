<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Company;


class Employer extends Model
{
    protected $fillable = ['user_id','name', 'company_name', 'website', 'phone', 'address'];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
      public function employerPackages()
    {
        return $this->hasMany(EmployerPackage::class);
    }
    public function jobs()
{
    return $this->hasMany(Job::class);
}

 public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
