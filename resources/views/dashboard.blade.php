<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("¡Usted está conectado!") }}

                    <!-- Botones ahora SI se verán -->
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{route('admin.users.index')}}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Usuarios</a>
                        <a href="{{route('admin.courses.index')}}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">Cursos</a>
                        <a href="{{route('admin.modules.index')}}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">Módulos</a>
                        <a href="{{route('admin.classes.index')}}" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">Clases</a>
                        <a href="{{route('admin.roles.index')}}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded">Roles</a>
                        <a href="{{route('admin.permissions.index')}}" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">Permisos</a>
                        <a href="{{route('admin.dashboard')}}" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">Panel Administrativo "Admin"</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
