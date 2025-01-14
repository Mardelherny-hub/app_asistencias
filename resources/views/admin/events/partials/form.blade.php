<div class="mb-3">
    <label for="name" class="form-label">Nombre del Evento<span class="text-danger">*</span></label>
    <input type="text" 
           class="form-control @error('name') is-invalid @enderror" 
           id="name" 
           name="name" 
           value="{{ old('name', $event->name ?? '') }}" 
           required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Descripción</label>
    <textarea class="form-control @error('description') is-invalid @enderror" 
              id="description" 
              name="description" 
              rows="4">{{ old('description', $event->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="start_date" class="form-label">Fecha y Hora de Inicio<span class="text-danger">*</span></label>
        <input type="datetime-local" 
               class="form-control @error('start_date') is-invalid @enderror" 
               id="start_date" 
               name="start_date" 
               value="{{ old('start_date', isset($event) ? date('Y-m-d\TH:i', strtotime($event->start_date)) : '') }}"
               required>
        @error('start_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="end_date" class="form-label">Fecha y Hora de Fin<span class="text-danger">*</span></label>
        <input type="datetime-local" 
               class="form-control @error('end_date') is-invalid @enderror" 
               id="end_date" 
               name="end_date" 
               value="{{ old('end_date', isset($event) ? date('Y-m-d\TH:i', strtotime($event->end_date)) : '') }}"
               required>
        @error('end_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="location" class="form-label">Ubicación</label>
    <input type="text" 
           class="form-control @error('location') is-invalid @enderror" 
           id="location" 
           name="location" 
           value="{{ old('location', $event->location ?? '') }}">
    @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label for="type" class="form-label">Tipo de Evento</label>
    <select class="form-select @error('type') is-invalid @enderror" 
            id="type" 
            name="type">
        <option value="">Seleccionar tipo...</option>
        <option value="conference" {{ (old('type', $event->type ?? '') == 'conference') ? 'selected' : '' }}>Conferencia</option>
        <option value="workshop" {{ (old('type', $event->type ?? '') == 'workshop') ? 'selected' : '' }}>Taller</option>
        <option value="webinar" {{ (old('type', $event->type ?? '') == 'webinar') ? 'selected' : '' }}>Webinar</option>
    </select>
    @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    <button type="submit" class="btn btn-primary">
        {{ isset($event) ? 'Actualizar' : 'Crear' }} Evento
    </button>
</div>

