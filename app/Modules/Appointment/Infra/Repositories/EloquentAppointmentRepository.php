<?php

namespace App\Modules\Appointment\Infra\Repositories;

use App\Modules\Appointment\Application\Dto\Create\CreateAppointmentInputDto;
use App\Modules\Appointment\Application\Dto\Update\UpdateAppointmentInputDto;
use App\Modules\Appointment\Domain\Repositories\AppointmentRepository;
use App\Modules\Appointment\Domain\Entities\Appointment;

class EloquentAppointmentRepository implements AppointmentRepository
{
    public function create(CreateAppointmentInputDto $inputDto): Appointment
    {
        return Appointment::create($inputDto->toArray());
    }

    public function findById(int $id): ?Appointment
    {
        return Appointment::find($id);
    }

    public function update(int $id, UpdateAppointmentInputDto $inputDto): Appointment
    {
        $appointment = Appointment::find($id);
        
        $data = $inputDto->toArray();
        if (is_null($data['updated_at'])) {
            unset($data['updated_at']);
        }
        
        $appointment->update($inputDto->toArray());
        return $appointment;
    }

    public function delete(int $id): bool
    {
        return Appointment::destroy($id);
    }


    public function save(Appointment $appointment): Appointment
    {
        $appointment->save();
        return $appointment;
    }

    public function findAll(
        ?string $date, 
        ?string $animalType,
    ): array
    {
        $query = Appointment::query();
        if (!is_null($date)) {
            $query->where('appointment_date', $date);
        }
        if (!is_null($animalType)) {
            $query->where('animal_type', $animalType);
        }
        return $query->get()->toArray();
    }

    public function assignToDoctor(int $appointmentId, int $doctorId): bool
    {
        $appointment = Appointment::find($appointmentId);
        if (is_null($appointment)) {
            return false;
        }
        
        $appointment->doctor_id = $doctorId;
        $appointment->save();
        return true;
    }

    public function findByDoctorAndDate(int $doctorId, string $date): array
    {
        return Appointment::where('doctor_id', $doctorId)->where('appointment_date', $date)->get()->toArray();
    }
}
