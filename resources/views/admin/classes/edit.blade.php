@extends('layouts.platform')

@section('content')
    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-8">
        Editar Clase
    </h2>

    <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <form action="{{ route('admin.classes.update', $class) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre de la Clase</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $class->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Contenido de la Clase (Texto)</label>
                    <textarea name="content" id="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('content', $class->content) }}</textarea>
                </div>

                <div>
                    <label for="video_url" class="block text-sm font-medium text-gray-700">URL del Video (Opcional)</label>
                    <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $class->video_url) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="https://www.youtube.com/watch?v=...">
                </div>

            </div>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('admin.modules.show', $class->module) }}" class="rounded-md bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancelar</a>
                <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Actualizar Clase</button>
            </div>
        </form>
    </div>
@endsection
