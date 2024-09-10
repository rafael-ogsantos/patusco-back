<?php

namespace App\Modules\Appointment\Application\UseCases;

use App\Modules\Appointment\Application\Dto\AppointmentDto;
use App\Modules\Appointment\Application\Dto\Create\CreateAppointmentInputDto;
use App\Modules\Appointment\Domain\Repositories\AppointmentRepository;

class ListAppointmentsUseCase
{
    private AppointmentRepository $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function execute(
        ?string $date, 
        ?string $animalType,
    ): array
    {
        $appointments = $this->appointmentRepository->findAll(
            $date, 
            $animalType
        );
        
        return array_map(function($appointment) {
            return new AppointmentDto(
                $appointment['id'],
                $appointment['person_name'],
                $appointment['email'],
                $appointment['animal_name'],
                $appointment['animal_type'],
                $appointment['animal_age'],
                $appointment['symptoms'],
                $appointment['appointment_date'],
                $appointment['period'],
                $appointment['updated_at'],
                $appointment['created_at']
            );
        }, $appointments);
    }
}