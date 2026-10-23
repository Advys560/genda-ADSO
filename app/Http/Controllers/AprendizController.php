<?php

namespace App\Http\Controllers;

use App\Models\Aprendiz;
use Illuminate\Http\Request;

class AprendizController extends Controller
{
    public function index()
    {
        $aprendices = Aprendiz::latest()->paginate(10);

        return view('aprendices.index', compact('aprendices'));
    }

    public function create()
    {
        return view('aprendices.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'documento' => ['required', 'string', 'max:40', 'unique:aprendices,documento'],
            'correo' => ['required', 'email', 'max:120', 'unique:aprendices,correo'],
            'ficha_id' => ['nullable', 'integer'],
        ]);

        Aprendiz::create($data);

        return redirect()->route('aprendices.index')->with('ok', 'Aprendiz creado correctamente.');
    }

    public function show(Aprendiz $aprendiz)
    {
        return view('aprendices.show', compact('aprendiz'));
    }

    public function edit(Aprendiz $aprendiz)
    {
        return view('aprendices.edit', compact('aprendiz'));
    }

    public function update(Request $request, Aprendiz $aprendiz)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'documento' => ['required', 'string', 'max:40', 'unique:aprendices,documento,' . $aprendiz->id],
            'correo' => ['required', 'email', 'max:120', 'unique:aprendices,correo,' . $aprendiz->id],
            'ficha_id' => ['nullable', 'integer'],
        ]);

        $aprendiz->update($data);

        return redirect()->route('aprendices.index')->with('ok', 'Aprendiz actualizado correctamente.');
    }

    public function destroy(Aprendiz $aprendiz)
    {
        $aprendiz->delete();

        return redirect()->route('aprendices.index')->with('ok', 'Aprendiz eliminado correctamente.');
    }
}
