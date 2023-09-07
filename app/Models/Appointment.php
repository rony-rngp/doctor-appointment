<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function main_schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class)->with('specialist');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'appointment_id');
    }
}
