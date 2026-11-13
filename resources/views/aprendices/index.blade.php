@extends('layouts.app')
@section('title', 'Aprendices')
@section('content')
    <section class="page-card">
        <div class="page-header">
            <h1>Aprendices</h1>
            <div class="page-actions">
                <a class="btn-primary" href="{{ route('aprendices.create') }}">+ Nuevo</a>
            </div>
        </div>

        <form class="search-form" action="{{ route('aprendices.index') }}" method="GET" role="search" data-auto-filter>
            <label for="campo">Filtrar por</label>
            <select id="campo" name="campo" data-filter-field>
                <option value="todos" @selected($campo === 'todos')>Todos los campos</option>
                <option value="nombre" @selected($campo === 'nombre')>Nombre</option>
                <option value="documento" @selected($campo === 'documento')>Documento</option>
                <option value="correo" @selected($campo === 'correo')>Correo</option>
            </select>
            <label class="sr-only" for="q">Término de búsqueda</label>
            <input id="q" type="search" name="q" value="{{ $q }}" placeholder="Escribe para filtrar aprendices" data-filter-query>
            <button class="btn-primary" type="submit">Filtrar</button>
            @if ($q !== '' || $campo !== 'todos')
                <a class="btn-secondary" href="{{ route('aprendices.index') }}">Limpiar</a>
            @endif
        </form>

        @if($aprendices->isEmpty())
            <div class="empty-state">
                {{ $q !== '' ? 'No se encontraron aprendices para este filtro.' : 'No hay aprendices registrados.' }}
            </div>
        @else
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Correo</th>
                            <th>Ficha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aprendices as $aprendiz)
                            <tr>
                                <td>{{ $aprendiz->id }}</td>
                                <td>{{ $aprendiz->nombre }}</td>
                                <td>{{ $aprendiz->documento }}</td>
                                <td>{{ $aprendiz->correo }}</td>
                                <td>{{ $aprendiz->ficha_id ?? 'Sin ficha' }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a class="table-action primary" href="{{ route('aprendices.show', $aprendiz) }}">Ver</a>
                                        <a class="table-action" href="{{ route('aprendices.edit', $aprendiz) }}">Editar</a>
                                        <form action="{{ route('aprendices.destroy', $aprendiz) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="table-action danger" type="submit" onclick="return confirm('¿Desea eliminar este aprendiz?')">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $aprendices->links() }}
            </div>
        @endif
    </section>
@endsection