<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;
use App\Models\Talk;
use App\Models\Speaker;

class WelcomeController extends Controller
{
    public function __invoke(): View
    {
        $currentEvent = Event::orderBy('start_date', 'asc')
            ->with('talks.speaker')
            ->first();

        //dd($currentEvent);

        return view('welcome', compact('currentEvent'));
    }
}