@extends('layouts.app')
@section('title', 'Nuevo Aprendiz')
@section('content')
    <section class="page-card">
        <div class="page-header">
            <h1>Nuevo Aprendiz</h1>
        </div>

        <form action="{{ route('aprendices.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" required>
                </div>

                <div class="form-group">
                    <label for="documento">Documento</label>
                    <input id="documento" type="text" name="documento" value="{{ old('documento') }}" required>
                </div>

                <div class="form-group full-width">
                    <label for="correo">Correo</label>
                    <input id="correo" type="email" name="correo" value="{{ old('correo') }}" required>
                </div>

                <div class="form-group">
                    <label for="ficha_id">Ficha ID</label>
                    <input id="ficha_id" type="number" name="ficha_id" value="{{ old('ficha_id') }}" min="1">
                </div>
            </div>

            <div class="form-actions">
                <button class="btn-primary" type="submit">Guardar</button>
                <a class="btn-secondary" href="{{ route('aprendices.index') }}">Cancelar</a>
            </div>
        </form>
    </section>
@endsection