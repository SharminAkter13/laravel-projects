<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $fillable = ['user_id','name', 'company_name', 'website', 'phone', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
      public function employerPackages()
    {
        return $this->hasMany(EmployerPackage::class);
    }
}
