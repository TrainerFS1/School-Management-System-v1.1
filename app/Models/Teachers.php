<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'teacher_id',
        'specialization',
        'phone_number',
        'address',
        'email',
        'password',
        'photo',
    ];
    
    public function teachingSchedules()
    {
        return $this->hasMany(TeachingSchedules::class);
    }
}
