@extends('adminlte::page')
@section('title', 'Editar Evento')

@section('content_header')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3">Editar Evento</h1>
        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.events.update', $event) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.events.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Set min date for start_date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('start_date').setAttribute('min', today + 'T00:00');

    // Update end_date min when start_date changes
    document.getElementById('start_date').addEventListener('change', function() {
        const startDate = this.value;
        document.getElementById('end_date').setAttribute('min', startDate);
        
        // If end_date is before new start_date, update it
        const endDate = document.getElementById('end_date').value;
        if (endDate && endDate < startDate) {
            document.getElementById('end_date').value = startDate;
        }
    });
});
</script>
@endpush

@push('css')
<style>
    .form-label {
        font-weight: 500;
    }
    
    @media (max-width: 576px) {
        .card-body {
            padding: 1rem;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>
@endpush