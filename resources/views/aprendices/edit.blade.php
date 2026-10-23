@extends('layouts.app')
@section('title', 'Editar Aprendiz')
@section('content')
    <section class="page-card">
        <div class="page-header">
            <h1>Editar Aprendiz</h1>
        </div>

        <form action="{{ route('aprendices.update', $aprendiz) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" type="text" name="nombre" value="{{ old('nombre', $aprendiz->nombre) }}" required>
                </div>

                <div class="form-group">
                    <label for="documento">Documento</label>
                    <input id="documento" type="text" name="documento" value="{{ old('documento', $aprendiz->documento) }}" required>
                </div>

                <div class="form-group full-width">
                    <label for="correo">Correo</label>
                    <input id="correo" type="email" name="correo" value="{{ old('correo', $aprendiz->correo) }}" required>
                </div>

                <div class="form-group">
                    <label for="ficha_id">Ficha ID</label>
                    <input id="ficha_id" type="number" name="ficha_id" value="{{ old('ficha_id', $aprendiz->ficha_id) }}" min="1">
                </div>
            </div>

            <div class="form-actions">
                <button class="btn-primary" type="submit">Actualizar</button>
                <a class="btn-secondary" href="{{ route('aprendices.index') }}">Cancelar</a>
            </div>
        </form>
    </section>
@endsection
