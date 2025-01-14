@extends('adminlte::page')
@section('title', 'Charlas')

@section('content_header')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3">Charlas</h1>
        <a href="{{ route('admin.talks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nueva Charla
        </a>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Ponente</th>
                            <th>Evento</th>
                            <th>Horario</th>
                            <th>QR</th>
                            <th width="140px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($talks as $talk)
                        <tr>
                            <td>{{ $talk->title }}</td>
                            <td>{{ $talk->speaker->name }}</td>
                            <td>{{ $talk->event->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($talk->start_time)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($talk->end_time)->format('H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.talks.qr', $talk) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-qrcode"></i>
                                </a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.talks.edit', $talk) }}" 
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.talks.destroy', $talk) }}" 
                                        method="POST" 
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar esta charla?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay charlas registradas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop