<?php

namespace App\Http\Controllers;

use App\Models\Aprendiz;
use App\Http\Requests\StoreUpdateAprendizRequest;
use Illuminate\Http\Request;

class AprendizController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:120'],
            'campo' => ['sometimes', 'in:todos,nombre,documento,correo'],
        ]);
        $q = trim($filters['q'] ?? '');
        $campo = $filters['campo'] ?? 'todos';

        $aprendices = Aprendiz::query()
            ->filter($q, $campo)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('aprendices.index', compact('aprendices', 'q', 'campo'));
    }

    public function create()
    {
        $aprendiz = new Aprendiz();

        return view('aprendices.create', compact('aprendiz'));
    }

    public function store(StoreUpdateAprendizRequest $request)
    {
        Aprendiz::create($request->validated());

        return redirect()->route('aprendices.index')->with('ok', 'Aprendiz creado.');
    }

    public function show(Aprendiz $aprendiz)
    {
        return view('aprendices.show', compact('aprendiz'));
    }

    public function edit(Aprendiz $aprendiz)
    {
        return view('aprendices.edit', compact('aprendiz'));
    }

    public function update(StoreUpdateAprendizRequest $request, Aprendiz $aprendiz)
    {
        $aprendiz->update($request->validated());

        return redirect()->route('aprendices.index')->with('ok', 'Aprendiz actualizado.');
    }

    public function destroy(Aprendiz $aprendiz)
    {
        $aprendiz->delete();

        return redirect()->route('aprendices.index')->with('ok', 'Aprendiz eliminado.');
    }
}