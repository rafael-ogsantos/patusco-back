<?php

namespace App\Modules\Appointment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Appointment\Application\Dto\AppointmentDto;
use App\Modules\Appointment\Application\UseCases\CreateAppointmentUseCase;
use App\Modules\Appointment\Application\Dto\Create\CreateAppointmentInputDto;
use App\Modules\Appointment\Application\Dto\Update\UpdateAppointmentInputDto;
use App\Modules\Appointment\Application\UseCases\AssingToDoctorUseCase;
use App\Modules\Appointment\Application\UseCases\FindAppointmentsByDateAndAnimalTypeUseCase;
use App\Modules\Appointment\Application\UseCases\ListAppointmentsUseCase;
use App\Modules\Appointment\Application\UseCases\ListAppointmentUseCase;
use App\Modules\Appointment\Application\UseCases\UpdateAppointmentUseCase;
use App\Modules\Appointment\Domain\Entities\Appointment;
use App\Modules\User\Domain\Enums\UserRole;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    private CreateAppointmentUseCase $createAppointmentUseCase;
    private ListAppointmentUseCase $listAppointmentUseCase;
    private ListAppointmentsUseCase $listAppointmentsUseCase;
    private UpdateAppointmentUseCase $updateAppointmentUseCase;
    private AssingToDoctorUseCase $assingToDoctorUseCase;

    public function __construct(
        CreateAppointmentUseCase $createAppointmentUseCase,
        ListAppointmentUseCase $listAppointmentUseCase,
        ListAppointmentsUseCase $listAppointmentsUseCase,
        UpdateAppointmentUseCase $updateAppointmentUseCase,
        AssingToDoctorUseCase $assingToDoctorUseCase
    )
    {
        $this->createAppointmentUseCase = $createAppointmentUseCase;
        $this->listAppointmentUseCase = $listAppointmentUseCase;
        $this->listAppointmentsUseCase = $listAppointmentsUseCase;
        $this->updateAppointmentUseCase = $updateAppointmentUseCase;
        $this->assingToDoctorUseCase = $assingToDoctorUseCase;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $date = $request->query('date', null);
        $animalType = $request->query('animal_type', null);


        $appointments = $this->listAppointmentsUseCase->execute($date, $animalType);

        return response()->json($appointments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'person_name' => 'required|string|max:255',
            'email' => 'required|email',
            'animal_name' => 'required|string|max:255',
            'animal_type' => 'required|string',
            'animal_age' => 'required|integer',
            'symptoms' => 'nullable|string',
            'appointment_date' => 'required|date',
            'period' => 'required|in:manhã,tarde',
        ]);

        $createAppointmentInputDto = new CreateAppointmentInputDto(
            new AppointmentDto(
                null,
                $validatedData['person_name'],
                $validatedData['email'],
                $validatedData['animal_name'],
                $validatedData['animal_type'],
                $validatedData['animal_age'],
                $validatedData['symptoms'],
                $validatedData['appointment_date'],
                $validatedData['period'],
                null,
                null
            )
        );

        $appointment = $this->createAppointmentUseCase->execute($createAppointmentInputDto);

        return response()->json($appointment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appointment = $this->listAppointmentUseCase->execute($id);

        return response()->json($appointment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $doctorId = auth()->user()->id; // Assumindo que o médico está autenticado

            $currentAppointment = Appointment::where('id', $id)
                ->where('doctor_id', $doctorId)
                ->firstOrFail();

            $validatedData = $request->validate([
                'person_name' => 'nullable|string|max:255',
                'email' => 'nullable|email',
                'animal_name' => 'nullable|string|max:255',
                'animal_type' => 'nullable|string',
                'animal_age' => 'nullable|integer',
                'symptoms' => 'nullable|string',
                'appointment_date' => 'nullable|date',
                'period' => 'nullable|in:manhã,tarde',
            ]);

            $updateAppointmentInputDto = new UpdateAppointmentInputDto(
                $id,
                $validatedData['person_name'] ?? $currentAppointment->person_name,
                $validatedData['email'] ?? $currentAppointment->email,
                $validatedData['animal_name'] ?? $currentAppointment->animal_name,
                $validatedData['animal_type'] ?? $currentAppointment->animal_type,
                $validatedData['animal_age'] ?? $currentAppointment->animal_age,
                $validatedData['symptoms'] ?? $currentAppointment->symptoms,
                $validatedData['appointment_date'] ?? $currentAppointment->appointment_date,
                $validatedData['period'] ?? $currentAppointment->period,
                null,
                null
            );

            $this->updateAppointmentUseCase->execute($id, $updateAppointmentInputDto);

            return response()->json(['message' => 'Appointment updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function assignToDoctor(Request $request, string $id)
    {
       try {
            // $recepcionist = auth()->user()->role;

            // echo $recepcionist; exit;

            // if ($recepcionist !== UserRole::RECEPTIONIST && $recepcionist !== UserRole::ADMIN) {
            //     return response()->json(['message' => 'You do not have permission to assign appointments'], 403);
            // }

            $doctorId = $request->input('doctor_id');
            $this->assingToDoctorUseCase->execute($id, $doctorId);

            return response()->json(['message' => 'Appointment assigned successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
       }
    }

    public function listByDoctor(Request $request)
    {
        $doctorId = auth()->user()->id;
        $date = $request->query('date');
        $animalType = $request->query('animal_type');

        $query = Appointment::where('doctor_id', $doctorId);

        if ($date) {
            $query->whereDate('appointment_date', $date);
        }

        if ($animalType) {
            $query->where('animal_type', $animalType);
        }

        $appointments = $query->get();

        return response()->json($appointments);
    }
}
