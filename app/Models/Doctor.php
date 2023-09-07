<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'doctor';

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('status', 1)->latest()->with('patient');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}
