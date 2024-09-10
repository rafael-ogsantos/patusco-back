<?php

namespace App\Modules\Appointment\Application\Dto\Create;

use App\Modules\Appointment\Application\Dto\AppointmentDto;

class CreateAppointmentOutputDto
{
    public $person_name;
    public $email;
    public $animal_name;
    public $animal_type;
    public $animal_age;
    public $symptoms;
    public $appointment_date;
    public $period;
    public $updated_at;
    public $created_at;
    public $id;

    public function __construct(AppointmentDto $appointment)
    {
        $this->person_name = $appointment->person_name;
        $this->email = $appointment->email;
        $this->animal_name = $appointment->animal_name;
        $this->animal_type = $appointment->animal_type;
        $this->animal_age = $appointment->animal_age;
        $this->symptoms = $appointment->symptoms;
        $this->appointment_date = $appointment->appointment_date;
        $this->period = $appointment->period;
        $this->updated_at = $appointment->updated_at;
        $this->created_at = $appointment->created_at;
        $this->id = $appointment->id;
    }
}