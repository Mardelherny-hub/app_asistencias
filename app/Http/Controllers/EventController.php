<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Event;


class EventController extends Controller
{
    public function showProgram(Event $event)
{
    $talks = $event->talks()
                  ->with('speaker')
                  ->orderBy('start_time')
                  ->get();

    return view('program', compact('event', 'talks'));
}
}
