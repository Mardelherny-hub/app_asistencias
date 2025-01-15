@extends('adminlte::page')
@section('title', 'Eventos')

@section('content_header')
<div class="container-fluid">
    <h1 class="h3 mb-4">Lista de Eventos</h1>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Crear Evento
        </a>
    </div>

    <div class="row g-3">
        @foreach ($events as $event)
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Encabezado con título y estado -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="card-title mb-1 fs-5">{{ $event->name }}</h5>
                            <span class="badge {{ $event->getStatusClass() }} mx-2">
                                {{ $event->getStatus() }}
                            </span>
                        </div>
                        <span class="badge bg-secondary">#{{ $event->id }}</span>
                    </div>

                    <!-- Información principal -->
                    <div class="mb-3">
                        <div class="mb-2">
                            <i class="fas fa-user text-secondary me-2"></i>
                            {{ $event->organizer->name }}
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-map-marker-alt text-secondary me-2"></i>
                            {{ $event->location ?: 'Ubicación no especificada' }}
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-clock text-secondary me-2"></i>
                            {{ $event->formatDateRange() }}
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-tag text-secondary me-2"></i>
                            {{ $event->type ?: 'Tipo no especificado' }}
                        </div>
                        @if($event->talks->count() > 0)
                        <div class="mb-2">
                            <i class="fas fa-microphone text-secondary me-2"></i>
                            {{ $event->talks->count() }} charlas programadas
                        </div>
                        @endif
                    </div>

                    <!-- Descripción con expansión -->
                    @if($event->description)
                    <div class="mb-3">
                        <p class="text-muted mb-0 description-text">
                            {{ Str::limit($event->description, 150) }}
                            @if(strlen($event->description) > 150)
                            <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#descriptionModal{{ $event->id }}">
                                Ver más
                            </a>
                            @endif
                        </p>
                    </div>
                    @endif

                    <!-- Botones de acción -->
                    <div class="d-flex flex-wrap gap-2 justify-content-end">
                        <a href="{{ route('admin.talks.create', ['event' => $event->id]) }}" 
                                class="btn btn-info btn-sm">
                            <i class="fas fa-microphone me-1"></i> Agregar Charla
                        </a>
                        <a href="{{ route('admin.events.show', $event->id) }}" 
                           class="btn btn-success mx-2">
                            <i class="fas fa-eye me-1"></i> Ver
                        </a>
                        <a href="{{ route('admin.events.edit', $event->id) }}" 
                           class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i> Editar
                        </a>
                        @role('super-admin')
                        <form action="{{ route('admin.events.destroy', $event->id) }}" 
                              method="POST" 
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este evento?')">
                                <i class="fas fa-trash me-1"></i> Eliminar
                            </button>
                        </form>
                        @endrole
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para descripción completa -->
        @if($event->description && strlen($event->description) > 150)
        <div class="modal fade" id="descriptionModal{{ $event->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $event->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ $event->description }}
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>

    <div class="mt-4">
        {{ $events->links() }}
    </div>
</div>

@stop

@push('css')
<style>
    /* Mejoras para la visualización móvil */
    @media (max-width: 576px) {
        .btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .gap-2 {
            gap: 0.5rem!important;
        }

        .description-text {
            font-size: 0.9rem;
        }
    }
    
    /* Estilos generales mejorados */
    .card {
        border: none;
        border-radius: 0.5rem;
        transition: transform 0.2s;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .card-body {
        border-radius: 0.5rem;
    }

    .btn {
        margin-bottom: 0.25rem;
        border-radius: 0.375rem;
    }

    /* Colores de estado personalizados */
    .badge-primary {
        background-color: #007bff;
    }
    
    .badge-success {
        background-color: #28a745;
    }
    
    .badge-secondary {
        background-color: #6c757d;
    }
    
    .badge-warning {
        background-color: #ffc107;
        color: #000;
    }
</style>
@endpush