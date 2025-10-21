@extends('layouts.platform')

@section('content')
    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-8">
        Mis Cursos
    </h2>

    @if($courses->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($courses as $course)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                    <a href="{{ route('student.course.study', $course) }}" class="block">
                        <img class="h-48 w-full object-cover" src="{{ $course->cover_image_url ?? 'https://via.placeholder.com/400x250.png/007bff/ffffff?text=Curso' }}" alt="Imagen del curso {{ $course->title }}">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $course->title }}</h3>
                            <p class="text-gray-600 mb-4 text-sm">Instructor: {{ $course->instructor->name ?? 'No asignado' }}</p>

                            {{-- Barra de Progreso Dinámica --}}
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-700">Progreso</span>
                                    <span class="text-sm font-medium text-gray-700">{{ $course->progress_percentage }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $course->progress_percentage }}%"></div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <span class="w-full text-center block rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                                    Continuar Estudiando
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center bg-white p-12 rounded-lg shadow-sm">
            <h3 class="text-xl font-medium text-gray-900">Aún no estás inscrito en ningún curso.</h3>
            <p class="mt-2 text-sm text-gray-500">Explora nuestro catálogo y encuentra tu próxima aventura de aprendizaje.</p>
            <div class="mt-6">
                <a href="{{ route('public.courses') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                    Explorar Cursos
                </a>
            </div>
        </div>
    @endif
@endsection
