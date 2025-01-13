@extends('adminlte::page')

@section('title', 'Asistencias - Panel de Control')

@section('content_header')
<div class="d-flex justify-content-between align-items-center px-3 py-4">
    <div>
        <h1 class="m-0">
            ¡Bienvenido, {{ Auth::user()->name }}!
            <small class="text-muted d-block font-weight-normal" style="font-size: 1rem;">
                {{ \Carbon\Carbon::now()->locale('es')->translatedFormat('l, d \d\e F \d\e Y') }}
            </small>
        </h1>
    </div>
    
</div>
@stop
@section('content')
<div>
    <h1>Hola</h1>
</div>
@stop