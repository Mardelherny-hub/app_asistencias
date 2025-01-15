<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Talk;
use App\Models\Speaker;
use App\Models\Event;
use Illuminate\Support\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class TalkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $talks = Talk::all();
        return view('admin.talks.index', compact('talks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event = null)
    {
        // Recuperar la lista de ponentes para el formulario
        $speakers = Speaker::all();
        // Obtener todos los eventos para el select
        $events = Event::all();

        return view('admin.talks.create', [
            'event' => $event,
            'speakers' => $speakers,
            'events' => $events,
            'talk' => null, // Para mantener compatibilidad con el formulario
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'title' => 'required|string|max:255',
            'speaker_id' => 'required|exists:speakers,id',
            'start_time' => [
                'required', 
                'date', 
                function ($attribute, $value, $fail) {
                    $event = Event::findOrFail(request('event_id'));
                    $startTime = Carbon::parse($value);
                    $endTime = Carbon::parse(request('end_time'));

                    // Validación de rango de evento
                    if (!$startTime->between($event->start_date, $event->end_date) || 
                        !$endTime->between($event->start_date, $event->end_date)) {
                        $fail(sprintf(
                            'La charla debe estar entre %s y %s (rango del evento "%s").',
                            $event->start_date,
                            $event->end_date,
                            $event->title
                        ));
                    }

                    // Validación de superposición de horarios
                    $overlappingTalks = Talk::where('event_id', $event->id)
                        ->where(function ($query) use ($startTime, $endTime) {
                            $query->whereBetween('start_time', [$startTime, $endTime])
                                ->orWhereBetween('end_time', [$startTime, $endTime])
                                ->orWhere(function ($q) use ($startTime, $endTime) {
                                    $q->where('start_time', '<=', $startTime)
                                        ->where('end_time', '>=', $endTime);
                                });
                        })
                        ->exists();

                    if ($overlappingTalks) {
                        $fail('Ya existe una charla programada en este horario.');
                    }
                }
            ],
            'end_time' => 'required|date|after:start_time',
            'description' => 'nullable|string',
        ]);

        $talk = Talk::create($validated);
        $talk->generateQrCode();

        return redirect()->back()->with('success', 'Charla agregada exitosamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function showQr(Talk $talk)
    {
        return view('talks.qr', compact('talk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Talk $talk)
    {
        $speakers = Speaker::all();
        return view('admin.talks.edit', compact('talk', 'speakers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Talk $talk)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'speaker_id' => 'required|exists:speakers,id',
            'start_time' => [
                'required', 
                'date', 
                function ($attribute, $value, $fail) use ($talk) {
                    $event = $talk->event;
                    $startTime = Carbon::parse($value);
                    $endTime = Carbon::parse(request('end_time'));

                    if (!$startTime->between($event->start_date, $event->end_date) || 
                        !$endTime->between($event->start_date, $event->end_date)) {
                        $fail('La charla debe estar dentro del rango de fechas del evento.');
                    }
                }
            ],
            'end_time' => 'required|date|after:start_time',
            'description' => 'nullable|string',
        ]);

        $talk->update($validated);

        return redirect()->back()->with('success', 'Charla actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Talk $talk)
    {
        $talk->delete();

        return redirect()->back()
            ->with('success', 'Charla eliminada exitosamente.');
    }
}
