<div class="mb-3">
    <label for="title" class="form-label">Título de la Charla</label>
    <input type="text" 
           class="form-control @error('title') is-invalid @enderror" 
           id="title" 
           name="title" 
           value="{{ old('title', $talk->title ?? '') }}" 
           required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="speaker" class="form-label">Ponente</label>
    <select class="form-control @error('speaker_id') is-invalid @enderror" 
            id="speaker_id" 
            name="speaker_id" 
            required>
        <option value="">Seleccionar ponente</option>
        @foreach($speakers as $speaker)
            <option value="{{ $speaker->id }}" 
                {{ old('speaker_id', $talk->speaker_id ?? '') == $speaker->id ? 'selected' : '' }}>
                {{ $speaker->name }}
            </option>
        @endforeach
    </select>
    @error('speaker_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="start_time" class="form-label">Hora de Inicio</label>
            <input type="time" 
                   class="form-control @error('start_time') is-invalid @enderror" 
                   id="start_time" 
                   name="start_time" 
                   value="{{ old('start_time', $talk->start_time ?? '') }}" 
                   required>
            @error('start_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="end_time" class="form-label">Hora de Fin</label>
            <input type="time" 
                   class="form-control @error('end_time') is-invalid @enderror" 
                   id="end_time" 
                   name="end_time" 
                   value="{{ old('end_time', $talk->end_time ?? '') }}" 
                   required>
            @error('end_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Descripción</label>
    <textarea class="form-control @error('description') is-invalid @enderror" 
              id="description" 
              name="description" 
              rows="3">{{ old('description', $talk->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('admin.talks.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>