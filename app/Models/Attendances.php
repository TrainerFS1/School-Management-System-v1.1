<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Students;

class Attendances extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'date',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class);
    }

    protected $casts = [
        'date' => 'date',
    ];
}
