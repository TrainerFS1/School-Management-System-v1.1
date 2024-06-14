<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'academic_year', 'payment_type', 'amount', 'payment_date', 'status', 'description',
    ];

    protected $casts = [
        'payment_type' => 'array',
        'payment_date' => 'date',
        'status' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class);
    }
}
