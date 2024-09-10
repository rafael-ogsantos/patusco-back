<?php

namespace App\Modules\Appointment\Application\UseCases;

use App\Modules\Appointment\Application\Dto\AppointmentDto;
use App\Modules\Appointment\Application\Dto\Create\CreateAppointmentInputDto;
use App\Modules\Appointment\Application\Dto\Create\CreateAppointmentOutputDto;
use App\Modules\Appointment\Domain\Services\AppointmentService;

class CreateAppointmentUseCase
{
    private AppointmentService $appointmentService;

    public function __construct(AppointmentService $appointmentService) {
        $this->appointmentService = $appointmentService;
    }

    public function execute(CreateAppointmentInputDto $inputDto): CreateAppointmentOutputDto
    {
        // $this->validate($inputDto);

       $appointment = $this->appointmentService->create($inputDto);

       return new CreateAppointmentOutputDto(
            new AppointmentDto(
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
            )
       );
    }

    public function validate(CreateAppointmentInputDto $inputDto)
    {
        // Validate inputDto
    }
}
