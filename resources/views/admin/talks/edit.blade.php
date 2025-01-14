@extends('adminlte::page')
@section('title', 'Editar Charla')

@section('content_header')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3">Editar Charla</h1>
        <a href="{{ route('admin.talks.index') }}" class="btn btn-outline-secondary">
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
                    <form action="{{ route('admin.talks.update', $talk) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.talks.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
