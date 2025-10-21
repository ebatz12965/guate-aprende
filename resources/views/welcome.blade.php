@extends('layouts.platform')

@section('content')
    <div class="text-center">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
            Bienvenido a GuateAprende
        </h1>
        <p class="mt-6 text-lg leading-8 text-gray-600">
            Tu plataforma para aprender y enseñar.
        </p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="{{ route('public.courses') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Explorar Cursos
            </a>
            <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-gray-900">
                Registrarse <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>
@endsection
