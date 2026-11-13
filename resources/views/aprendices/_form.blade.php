@csrf

@if ($aprendiz->exists)
    @method('PUT')
@endif

<div class="form-grid">
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input id="nombre" type="text" name="nombre" value="{{ old('nombre', $aprendiz->nombre) }}" maxlength="120" required>
        @error('nombre')
            <p class="field-error" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="documento">Documento</label>
        <input id="documento" type="text" name="documento" value="{{ old('documento', $aprendiz->documento) }}" maxlength="40" required>
        @error('documento')
            <p class="field-error" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group full-width">
        <label for="correo">Correo</label>
        <input id="correo" type="email" name="correo" value="{{ old('correo', $aprendiz->correo) }}" maxlength="120" required>
        @error('correo')
            <p class="field-error" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="ficha_id">Ficha ID</label>
        <input id="ficha_id" type="number" name="ficha_id" value="{{ old('ficha_id', $aprendiz->ficha_id) }}" min="1">
        @error('ficha_id')
            <p class="field-error" role="alert">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="form-actions">
    <button class="btn-primary" type="submit">{{ $aprendiz->exists ? 'Actualizar' : 'Guardar' }}</button>
    <a class="btn-secondary" href="{{ route('aprendices.index') }}">Cancelar</a>
</div>
