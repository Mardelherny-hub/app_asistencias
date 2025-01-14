<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminEventController extends Controller
{
    // Listar eventos
    public function index()
    {
        $events = Event::with('organizer')->paginate(10); // Paginar con relaciones
        return view('admin.events.index', compact('events'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('admin.events.create');
    }

    // Guardar un nuevo evento
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|enum:conference, workshop, webinar',            
        ]);

        $validated['user_id'] = auth()->id(); // Asignar el usuario actual como organizador
        $event = Event::create($validated);        

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento creado exitosamente.');
    }

    // Mostrar un evento
    public function show(Event $event)
    {
        $talks = $event->talks()->paginate(10); // Paginación de charlas relacionadas
        return view('admin.events.show', compact('event', 'talks'));
    }

    // Mostrar formulario de edición
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    // Actualizar evento
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|enum:conference, workshop, webinar',
        ]);

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento actualizado exitosamente.');
    }

    // Eliminar un evento
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento eliminado exitosamente.');
    }
}
