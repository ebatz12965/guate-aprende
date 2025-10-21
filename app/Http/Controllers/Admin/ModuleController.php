<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function create(Course $course)
    {
        return view('admin.modules.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $module = new Module($request->all());
        $course->modules()->save($module);

        return redirect()->route('admin.courses.show', $course)->with('success', 'Módulo creado correctamente.');
    }

    public function show(Module $module)
    {
        // Cargar el módulo con sus clases
        $module->load('classes');
        return view('admin.modules.show', compact('module'));
    }

    public function edit(Module $module)
    {
        // Lógica para mostrar el formulario de edición del módulo
        return view('admin.modules.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $module->update($request->all());

        return redirect()->route('admin.courses.show', $module->course)->with('success', 'Módulo actualizado correctamente.');
    }

    public function destroy(Module $module)
    {
        $course = $module->course;
        $module->delete();

        return redirect()->route('admin.courses.show', $course)->with('success', 'Módulo eliminado correctamente.');
    }
}
