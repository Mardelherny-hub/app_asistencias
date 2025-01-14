@extends('adminlte::page')
@section('title', 'Detalle del Evento')

@section('content_header')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3">{{ $event->name }}</h1>
        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Información Principal -->
        <div class="col-12 col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-start">
                        <div>
                            <span class="badge {{ $event->getStatusClass() }} mb-2">
                                {{ $event->getStatus() }}
                            </span>
                            <h5><i class="fas fa-clock text-secondary me-2"></i>{{ $event->formatDateRange() }}</h5>
                            <h6><i class="fas fa-map-marker-alt text-secondary me-2"></i>{{ $event->location }}</h6>
                            <p class="text-muted mb-0">
                                <i class="fas fa-tag text-secondary me-2"></i>{{ $event->type }}
                            </p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i> Editar
                            </a>
                            @role('super-admin')
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('¿Estás seguro de eliminar este evento?')">
                                    <i class="fas fa-trash me-1"></i> Eliminar
                                </button>
                            </form>
                            @endrole
                        </div>
                    </div>

                    @if($event->description)
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Descripción</h5>
                        <p class="text-muted">{{ $event->description }}</p>
                    </div>
                    @endif

                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Organizador</h5>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-circle fa-2x text-secondary me-3"></i>
                            <div>
                                <h6 class="mb-0">{{ $event->organizer->name }}</h6>
                                <p class="text-muted mb-0">{{ $event->organizer->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar con Charlas -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-microphone me-2"></i>Charlas
                    </h5>
                    <button type="button" 
                            class="btn btn-primary btn-sm"
                            onclick="prepareTalkModal({{ $event->id }}, '{{ $event->start_date }}', '{{ $event->end_date }}')"
                            data-bs-toggle="modal" 
                            data-bs-target="#quickTalkModal">
                        <i class="fas fa-plus me-1"></i> Agregar Charla
                    </button>
                </div>
                <div class="card-body">
                    @if($event->talks->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($event->talks as $talk)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">{{ $talk->title }}</h6>
                                        <p class="text-muted small mb-1">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($talk->start_time)->format('H:i') }} - 
                                            {{ \Carbon\Carbon::parse($talk->end_time)->format('H:i') }}
                                        </p>
                                        <p class="text-muted small mb-0">
                                            <i class="fas fa-user me-1"></i>
                                            {{ $talk->speaker->name }}
                                        </p>
                                        @if($talk->description)
                                            <p class="small text-muted mt-2 mb-0">{{ $talk->description }}</p>
                                        @endif
                                    </div>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" 
                                                class="btn btn-outline-warning"
                                                onclick="editTalk({{ $talk->id }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @role('super-admin')
                                        <form action="{{ route('admin.talks.destroy', $talk) }}" 
                                            method="POST" 
                                            class="d-inline"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta charla?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endrole
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">No hay charlas programadas</p>
                    @endif
                </div>
            </div>

            <!-- Información Adicional -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Información Adicional
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <strong>Creado:</strong> 
                            {{ $event->created_at->format('d/m/Y H:i') }}
                        </li>
                        <li class="mb-2">
                            <strong>Última actualización:</strong> 
                            {{ $event->updated_at->format('d/m/Y H:i') }}
                        </li>
                        <li>
                            <strong>ID del Evento:</strong> 
                            #{{ $event->id }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('css')
<style>
    @media (max-width: 576px) {
        .card-body {
            padding: 1rem;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    }

    .card {
        border: none;
        border-radius: 0.5rem;
    }

    .list-group-item:first-child {
        border-top: none;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }
</style>
@endpush

@push('js')
<script>
function prepareTalkModal(eventId, startDate, endDate) {
    document.getElementById('eventIdInput').value = eventId;
    
    // Convert event dates to local date
    const eventStart = new Date(startDate);
    const eventEnd = new Date(endDate);
    
    // Set min/max times based on event schedule
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');
    
    startTimeInput.min = eventStart.toTimeString().slice(0,5);
    endTimeInput.max = eventEnd.toTimeString().slice(0,5);
    
    startTimeInput.addEventListener('change', function() {
        endTimeInput.min = this.value;
        if (endTimeInput.value && endTimeInput.value < this.value) {
            endTimeInput.value = this.value;
        }
    });
}

function editTalk(talkId) {
    // Aquí iría la lógica para cargar y editar una charla existente
    // Podrías hacer una petición AJAX para obtener los datos y llenar el modal
}
</script>
@endpush