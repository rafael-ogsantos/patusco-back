<?php

namespace App\Modules\Appointment\Application\Dto\Create;

use App\Modules\Appointment\Application\Dto\AppointmentDto;

class CreateAppointmentInputDto
{
    public AppointmentDto $appointmentDto;

    public function __construct(AppointmentDto $appointmentDto)
    {
        $this->appointmentDto = $appointmentDto;
    }

    public function toArray(): array
    {
        return [
            'person_name' => $this->appointmentDto->person_name,
            'email' => $this->appointmentDto->email,
            'animal_name' => $this->appointmentDto->animal_name,
            'animal_type' => $this->appointmentDto->animal_type,
            'animal_age' => $this->appointmentDto->animal_age,
            'symptoms' => $this->appointmentDto->symptoms,
            'appointment_date' => $this->appointmentDto->appointment_date,
            'period' => $this->appointmentDto->period,
        ];
    }
}
