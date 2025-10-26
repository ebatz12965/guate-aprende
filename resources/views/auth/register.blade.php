@extends('layouts.platform')

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-gray-50 dark:bg-gray-900 px-4 py-8">
        <div class="w-full max-w-md space-y-8 bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Crea tu cuenta en <span class="text-indigo-600">GuateAprende</span>
                </h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Únete a nuestra comunidad y comienza a aprender 📚
                </p>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre completo</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                           class="mt-2 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo electrónico</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                           class="mt-2 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contraseña</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                           class="mt-2 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirmar contraseña -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmar contraseña</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                           class="mt-2 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Botón -->
                <div class="flex flex-col gap-4">
                    <button type="submit"
                            class="w-full flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition duration-150 ease-in-out">
                        Registrarse
                    </button>

                    <div class="text-center text-sm text-gray-600 dark:text-gray-400">
                        ¿Ya tienes cuenta?
                        <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                            Inicia sesión
                        </a>
                    </div>
                </div>
            </form>

            <!-- Separador -->
            <div class="flex items-center justify-center mt-6">
                <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
                <div class="px-4 text-gray-500 dark:text-gray-400">o</div>
                <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
            </div>

            <!-- Registro con Google -->
            <div class="mt-4">
                <a href="{{ route('socialite.redirect', 'google') }}"
                   class="w-full inline-flex items-center justify-center gap-2 rounded-md border border-gray-300 dark:border-gray-600 px-4 py-2 bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    <img src="https://www.google.com/favicon.ico" alt="Google icon" class="w-5 h-5">
                    Registrarse con Google
                </a>
            </div>
        </div>
    </div>
@endsection
