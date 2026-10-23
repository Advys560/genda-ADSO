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

        @if($aprendices->isEmpty())
            <div class="empty-state">No hay aprendices registrados.</div>
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