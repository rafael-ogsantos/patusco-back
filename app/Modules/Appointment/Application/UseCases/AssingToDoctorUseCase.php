<?php

namespace App\Modules\Appointment\Application\UseCases;

use App\Modules\Appointment\Domain\Repositories\AppointmentRepository;
use App\Modules\User\Domain\Entities\User;
use App\Modules\User\Domain\Repositories\UserRepository;

class AssingToDoctorUseCase
{
    private AppointmentRepository $appointmentRepository;

    public function __construct(
        AppointmentRepository $appointmentRepository,
    )
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function execute(int $appointmentId, int $doctorId): bool
    {
        $appointment = $this->appointmentRepository->findById($appointmentId);
        
        if (!$appointment) {
            throw new \Exception('Appointment not found');
        }

        $doctor = User::where('role', 'doctor')->find($doctorId);

        if (!$doctor) {
            throw new \Exception('Doctor not found');
        }

        return $this->appointmentRepository->assignToDoctor($appointmentId, $doctorId);
    }
}