@extends('layouts.platform')

@section('content')
    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-8">
        Nuestros Cursos
    </h2>

    @if($courses->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($courses as $course)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                    <img class="h-48 w-full object-cover" src="{{ $course->cover_image_url ?? 'https://via.placeholder.com/400x250.png/007bff/ffffff?text=Curso' }}" alt="Imagen del curso {{ $course->title }}">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $course->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($course->description, 100) }}</p>
                        <a href="{{ route('public.course.detail', $course) }}" class="w-full text-center block rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Ver detalles
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center bg-white p-12 rounded-lg shadow-sm">
            <h3 class="text-xl font-medium text-gray-900">No hay cursos disponibles en este momento.</h3>
            <p class="mt-2 text-sm text-gray-500">Vuelve a visitarnos pronto para ver nuevos cursos.</p>
        </div>
    @endif
@endsection
