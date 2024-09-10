<?php

namespace App\Modules\Appointment\Application\UseCases;

use App\Modules\Appointment\Application\Dto\AppointmentDto;
use App\Modules\Appointment\Application\Dto\Update\UpdateAppointmentInputDto;
use App\Modules\Appointment\Domain\Services\AppointmentService;

class UpdateAppointmentUseCase
{
    private AppointmentService $appointmentService;

    public function __construct(AppointmentService $appointmentService) {
        $this->appointmentService = $appointmentService;
    }
    
    public function execute(int $id, UpdateAppointmentInputDto $inputDto): AppointmentDto
    {
        // $this->validate($inputDto);

        $appointment = $this->appointmentService->update($id, $inputDto);

        return new AppointmentDto(
            $appointment->id,
            $appointment->person_name,
            $appointment->email,
            $appointment->animal_name,
            $appointment->animal_type,
            $appointment->animal_age,
            $appointment->symptoms,
            $appointment->appointment_date,
            $appointment->period,
            $appointment->updated_at,
            $appointment->created_at
        );
    }
}