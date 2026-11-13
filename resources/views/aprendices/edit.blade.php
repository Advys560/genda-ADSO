@extends('layouts.app')
@section('title', 'Editar Aprendiz')
@section('content')
    <section class="page-card">
        <div class="page-header">
            <h1>Editar Aprendiz</h1>
        </div>

        <form action="{{ route('aprendices.update', $aprendiz) }}" method="POST">
            @include('aprendices._form')
        </form>
    </section>
@endsection
