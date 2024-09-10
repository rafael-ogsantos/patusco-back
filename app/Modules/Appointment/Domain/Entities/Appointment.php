<?php

namespace App\Modules\Appointment\Domain\Entities;

use App\Modules\Doctor\Models\Doctor;
use App\Modules\User\Domain\Entities\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_name',
        'email',
        'animal_name',
        'animal_type',
        'animal_age',
        'symptoms',
        'appointment_date',
        'period',
        'doctor_id',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class)->where('role', 'doctor');
    }
}
