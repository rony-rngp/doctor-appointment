<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function appointment()
    {
        return $this->belongsTo(Appointment::class)->with('doctor');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
