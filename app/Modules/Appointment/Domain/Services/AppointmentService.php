<?php

namespace App\Modules\Appointment\Domain\Services;

use App\Modules\Appointment\Domain\Repositories\AppointmentRepository;
use App\Modules\Appointment\Application\Dto\Create\CreateAppointmentInputDto;
use App\Modules\Appointment\Application\Dto\Update\UpdateAppointmentInputDto;
use App\Modules\Appointment\Domain\Entities\Appointment;

class AppointmentService
{
    private AppointmentRepository $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function create(CreateAppointmentInputDto $inputDto): Appointment
    {
        return $this->appointmentRepository->create($inputDto);
    }

    public function update(int $id, UpdateAppointmentInputDto $inputDto): Appointment
    {
        return $this->appointmentRepository->update($id, $inputDto);
    }

    public function reeschedule(int $id, UpdateAppointmentInputDto $inputDto): Appointment
    {
        $appointment = $this->appointmentRepository->findById($id);

        if ($appointment->status !== 'scheduled') {
            throw new \Exception('Only scheduled appointments can be rescheduled');
        }

        $existingAppointment = $this->appointmentRepository->findByDateAndTime(
            $inputDto->appointmentDto->appointment_date, 
            $inputDto->appointmentDto->period
        );
        if ($existingAppointment) {
            throw new \Exception('There is already an appointment scheduled for this date and time');
        }

        return $this->appointmentRepository->update($id, $inputDto);
    }

    public function cancel(int $id): Appointment
    {
        $appointment = $this->appointmentRepository->findById($id);

        if ($appointment->status !== 'scheduled') {
            throw new \Exception('Only scheduled appointments can be canceled');
        }

        $appointment->status = 'canceled';
        return $this->appointmentRepository->save($appointment);
    }

    public function findById(int $id): ?Appointment
    {
        return $this->appointmentRepository->findById($id);
    }

    public function findAll(): array
    {
        return $this->appointmentRepository->findAll();
    }
}
