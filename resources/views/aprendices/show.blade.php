@extends('layouts.app')
@section('title', 'Detalle Aprendiz')
@section('content')
    <section class="page-card">
        <div class="page-header">
            <h1>{{ $aprendiz->nombre }}</h1>
            <div class="page-actions">
                <a class="btn-primary" href="{{ route('aprendices.edit', $aprendiz) }}">Editar</a>
                <a class="btn-secondary" href="{{ route('aprendices.index') }}">Volver al listado</a>
            </div>
        </div>

        <ul class="meta-list">
            <li><strong>ID:</strong> {{ $aprendiz->id }}</li>
            <li><strong>Documento:</strong> {{ $aprendiz->documento }}</li>
            <li><strong>Correo:</strong> {{ $aprendiz->correo }}</li>
            <li><strong>Ficha:</strong> {{ $aprendiz->ficha_id ?? 'Sin ficha' }}</li>
        </ul>
    </section>
@endsection
