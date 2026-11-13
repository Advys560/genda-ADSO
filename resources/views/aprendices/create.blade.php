@extends('layouts.app')
@section('title', 'Nuevo Aprendiz')
@section('content')
    <section class="page-card">
        <div class="page-header">
            <h1>Nuevo Aprendiz</h1>
        </div>

        <form action="{{ route('aprendices.store') }}" method="POST">
            @include('aprendices._form')
        </form>
    </section>
@endsection