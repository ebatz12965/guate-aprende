<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Lista de Usuarios</h3>
                    <ul class="space-y-2">
                        @foreach($users as $user)
                            <li class="p-4 border rounded-md flex justify-between items-center">
                                <span>{{ $user->name }} - {{ $user->email }}</span>
                                <div class="space-x-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-500 hover:underline">Editar</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
