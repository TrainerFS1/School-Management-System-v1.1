<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Students;

class Grades extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'student_id',
        'subject',
        'grade',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class);
    }
}
