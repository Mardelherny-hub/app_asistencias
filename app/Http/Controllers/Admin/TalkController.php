<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Talk;
use App\Models\Speaker;
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
    public function create()
    {
        $speakers = Speaker::all();
        return view('admin.talks.create', compact('speakers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'title' => 'required|string|max:255',
            'speaker' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'description' => 'nullable|string',
        ]);

        $talk = Talk::create($validated);

        // Generar QR code después de crear la charla
        $talk->generateQrCode();

        return redirect()->back()
            ->with('success', 'Charla agregada exitosamente.');
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
            'speaker' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'description' => 'nullable|string',
        ]);

        $talk->update($validated);

        return redirect()->back()
            ->with('success', 'Charla actualizada exitosamente.');
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
