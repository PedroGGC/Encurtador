<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Estatísticas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <h3 class="text-lg font-medium mb-4">Bem-vindo(a), {{ auth()->user()->name }}!</h3>
                    <p class="text-sm text-gray-600">Abaixo estão as estatísticas dos links que você encurtou.</p>
                </div>
            </div>

            <!-- Livewire Component -->
            <livewire:admin-dashboard />

        </div>
    </div>
</x-app-layout>