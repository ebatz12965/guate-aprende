<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Category;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->with('instructor')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        $levels = Level::all();
        $instructors = User::role('Instructor')->get();
        return view('admin.courses.create', compact('categories', 'levels', 'instructors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $course = new Course($request->all());
        $course->slug = Str::slug($request->title);
        $course->save();

        return redirect()->route('admin.courses.show', $course)->with('success', 'Curso creado correctamente. Ahora puedes añadir módulos.');
    }

    public function show(Course $course)
    {
        $course->load('modules', 'students');
        $excludeIds = $course->students->pluck('id')->push($course->user_id)->all();
        $potentialStudents = User::whereNotIn('id', $excludeIds)->get();
        return view('admin.courses.show', compact('course', 'potentialStudents'));
    }

    public function edit(Course $course)
    {
        $categories = Category::all();
        $levels = Level::all();
        $instructors = User::role('Instructor')->get();
        return view('admin.courses.edit', compact('course', 'categories', 'levels', 'instructors'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $course->fill($request->except('slug'));
        $course->slug = Str::slug($request->title);
        $course->save();

        return redirect()->route('admin.courses.show', $course)->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Curso eliminado correctamente.');
    }

    /**
     * Cambia el estado de publicación de un curso.
     */
    public function toggleStatus(Course $course)
    {
        if ($course->status == 'draft') {
            $course->status = 'published';
            $message = 'Curso publicado correctamente.';
        } else {
            $course->status = 'draft';
            $message = 'El curso ha sido pasado a borrador.';
        }
        $course->save();

        return redirect()->route('admin.courses.show', $course)->with('success', $message);
    }
}
