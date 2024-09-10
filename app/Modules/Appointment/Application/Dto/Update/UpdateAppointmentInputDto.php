<?php

namespace App\Modules\Appointment\Application\Dto\Update;

class UpdateAppointmentInputDto
{
    public string $id;
    public ?string $person_name;
    public ?string $email;
    public ?string $animal_name;
    public ?string $animal_type;
    public ?int $animal_age;
    public ?string $symptoms;
    public ?string $appointment_date;
    public ?string $period;
    public ?string $updated_at;

    public function __construct(
        string $id,
        string $person_name,
        string $email,
        string $animal_name,
        string $animal_type,
        int $animal_age,
        ?string $symptoms,
        string $appointment_date,
        string $period,
        ?string $updated_at,
        ?string $created_at
    ) {
        $this->id = $id;
        $this->person_name = $person_name;
        $this->email = $email;
        $this->animal_name = $animal_name;
        $this->animal_type = $animal_type;
        $this->animal_age = $animal_age;
        $this->symptoms = $symptoms;
        $this->appointment_date = $appointment_date;
        $this->period = $period;
        $this->updated_at = $updated_at;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'person_name' => $this->person_name,
            'email' => $this->email,
            'animal_name' => $this->animal_name,
            'animal_type' => $this->animal_type,
            'animal_age' => $this->animal_age,
            'symptoms' => $this->symptoms,
            'appointment_date' => $this->appointment_date,
            'period' => $this->period,
            'updated_at' => $this->updated_at
        ];
    }
}