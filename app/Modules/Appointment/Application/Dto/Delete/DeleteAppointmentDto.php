<?php

namespace App\Modules\Appointment\Application\Dto\Delete;

class DeleteAppointmentDto
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}