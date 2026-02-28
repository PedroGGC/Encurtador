<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Estatísticas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl mb-8 outline outline-1 -outline-offset-1 outline-gray-200 dark:outline-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-2">Bem-vindo(a), <span
                            class="font-bold text-indigo-600 dark:text-indigo-400">{{ auth()->user()->name }}</span>!
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Abaixo estão as estatísticas atualizadas em
                        tempo real dos seus links.</p>
                </div>
            </div>

            <!-- Livewire Component -->
            <livewire:admin-dashboard />

        </div>
    </div>
</x-app-layout>