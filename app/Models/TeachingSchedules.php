<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingSchedules extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject',
        'teaching_day',
        'start_time',
        'end_time',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teachers::class);
    }
}
