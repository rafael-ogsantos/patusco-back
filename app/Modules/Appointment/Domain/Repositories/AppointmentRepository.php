<?php

namespace App\Modules\Appointment\Domain\Repositories;

use App\Modules\Appointment\Application\Dto\Create\CreateAppointmentInputDto;
use App\Modules\Appointment\Application\Dto\Update\UpdateAppointmentInputDto;
use App\Modules\Appointment\Domain\Entities\Appointment;

interface AppointmentRepository
{
    public function create(CreateAppointmentInputDto $inputDto): Appointment;
    public function findById(int $id): ?Appointment;
    public function update(int $id, UpdateAppointmentInputDto $inputDto): Appointment;
    public function delete(int $id): bool;
    public function save(Appointment $appointment): Appointment;
    public function findAll(
        ?string $date,
        ?string $animalType
    ): array;
    public function assignToDoctor(int $appointmentId, int $doctorId): bool;
    public function findByDoctorAndDate(int $doctorId, string $date): array;
}
