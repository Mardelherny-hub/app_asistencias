<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Talk;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function markAttendance($code)
    {
        $talk = Talk::where('qr_code', $code)->firstOrFail();
        
        // Verificar si el usuario ya marcó asistencia
        $existingAttendance = Attendance::where('talk_id', $talk->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($existingAttendance) {
            return redirect()->back()
                ->with('error', 'Ya has registrado tu asistencia a esta charla.');
        }

        // Registrar la asistencia
        Attendance::create([
            'talk_id' => $talk->id,
            'user_id' => auth()->id(),
            'attended_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Asistencia registrada exitosamente.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
