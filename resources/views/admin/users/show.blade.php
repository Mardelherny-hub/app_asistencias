@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
<div class="card">    
    <x-adminlte-profile-widget name="{{ $user->name }}" 
        desc="{{ $user->getRoleNames()->first() ?? 'Sin rol asignado' }}" 
        theme="teal"
        >
        <x-adminlte-profile-col-item title="Asistencias" text="5" url="#"/>
        <x-adminlte-profile-col-item title="Contacto" text="{{ $user->email }}" url="#"/>
        <x-adminlte-profile-col-item title="Posts" text="37" url="#"/>
    </x-adminlte-profile-widget>
@stop