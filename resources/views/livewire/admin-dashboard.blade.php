<div>
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h4 class="text-gray-500 text-sm font-medium mb-1">Total de Links</h4>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalLinks }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h4 class="text-gray-500 text-sm font-medium mb-1">Total de Cliques</h4>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalClicks }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h4 class="text-gray-500 text-sm font-medium mb-1">Link Mais Acessado</h4>
            <p class="text-lg font-bold text-indigo-600 truncate">
                @if($topLink)
                    {{ url($topLink->code) }} ({{ $topLink->clicks }})
                @else
                    Nenhum
                @endif
            </p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Short
                        Link</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Original
                        URL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliques
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Último
                        Clique</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($links as $link)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ url($link->code) }}" target="_blank"
                                class="text-indigo-600 hover:text-indigo-900 font-medium">
                                {{ $link->code }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-gray-900 truncate block max-w-xs" title="{{ $link->original_url }}">
                                {{ $link->original_url }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                            {{ $link->clicks }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm">
                            {{ $link->last_click ? $link->last_click->diffForHumans() : 'Nunca' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="deleteLink({{ $link->id }})" wire:confirm="Tem certeza que deseja excluir?"
                                class="text-red-600 hover:text-red-900">Excluir</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            Nenhum link encontrado. Comece a encurtar na página inicial!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>