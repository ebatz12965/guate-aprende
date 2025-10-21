<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function create(Module $module)
    {
        return view('admin.classes.create', compact('module'));
    }

    public function store(Request $request, Module $module)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
        ]);

        $class = new SchoolClass($request->all());
        $module->classes()->save($class);

        return redirect()->route('admin.modules.show', $module)->with('success', 'Clase creada correctamente.');
    }

    public function show(SchoolClass $class)
    {
        $class->load('tasks');
        return view('admin.classes.show', compact('class'));
    }

    /**
     * Muestra el formulario para editar una clase existente.
     */
    public function edit(SchoolClass $class)
    {
        return view('admin.classes.edit', compact('class'));
    }

    /**
     * Actualiza una clase existente en la base de datos.
     */
    public function update(Request $request, SchoolClass $class)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
        ]);

        $class->update($request->all());

        return redirect()->route('admin.modules.show', $class->module)->with('success', 'Clase actualizada correctamente.');
    }

    public function destroy(SchoolClass $class)
    {
        $module = $class->module;
        $class->delete();

        return redirect()->route('admin.modules.show', $module)->with('success', 'Clase eliminada correctamente.');
    }
}
