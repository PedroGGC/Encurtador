<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Encurtador de Links') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>

<body class="antialiased font-sans bg-gray-50 text-gray-900 min-h-screen flex flex-col">

    <!-- Top Navigation -->
    <nav class="bg-indigo-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center font-bold text-xl tracking-tight">
                    🔗 LinkShort
                </div>
                <div class="flex space-x-4">
                    @auth
                        <a href="{{ route('admin.dashboard') }}"
                            class="hover:bg-indigo-500 px-3 py-2 rounded-md text-sm font-medium transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="hover:bg-indigo-500 px-3 py-2 rounded-md text-sm font-medium transition-colors">Log
                            in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="hover:bg-indigo-500 px-3 py-2 rounded-md text-sm font-medium transition-colors">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 max-w-4xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-12 flex flex-col items-center justify-center">

        <div class="text-center mb-10 text-gray-800">
            <h1 class="text-5xl font-extrabold mb-4 text-indigo-900">Encurte Seus Links</h1>
            <p class="text-xl text-gray-600">Simples, rápido e com relatórios automáticos. Insira sua URL longa abaixo.
            </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-xl w-full border border-gray-100">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center">
                    <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>

                <div class="mb-8 flex flex-col items-center">
                    <p class="text-gray-600 mb-2 font-medium">Seu link encurtado:</p>
                    <div class="flex items-center space-x-3 w-full max-w-md">
                        <input type="text" readonly value="{{ session('short_link') }}"
                            class="flex-1 p-3 border border-indigo-200 bg-indigo-50 text-indigo-900 font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-center"
                            id="shortenedLink">
                        <button onclick="copyToClipboard()"
                            class="bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700 transition font-medium whitespace-nowrap shadow-sm hover:shadow">
                            Copiar
                        </button>
                    </div>

                    <div
                        class="mt-8 p-6 bg-white border border-gray-100 shadow-sm rounded-xl flex flex-col items-center transition-transform hover:scale-105">
                        <p class="text-gray-500 text-sm mb-4 font-semibold uppercase tracking-wider">QR Code</p>
                        <div class="p-2 bg-white rounded-xl shadow-sm border border-gray-100">
                            {!! QrCode::size(200)->generate(session('short_link')) !!}
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('shorten') }}" method="POST" class="relative">
                @csrf
                <div class="flex flex-col sm:flex-row gap-4">
                    <input type="url" name="url" required placeholder="https://exemplo.com/url-muito-longa"
                        class="flex-1 px-5 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all text-lg"
                        value="{{ old('url') }}">
                    <button type="submit"
                        class="bg-indigo-600 border border-transparent text-white px-8 py-4 rounded-xl hover:bg-indigo-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-bold transition-all text-lg shadow">
                        Encurtar
                    </button>
                </div>
                @error('url')
                    <p class="text-red-500 mt-2 ml-1 text-sm font-medium flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </form>
        </div>

        <!-- Features grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16 w-full opacity-80">
            <div class="text-center p-6">
                <div
                    class="bg-indigo-100 text-indigo-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">
                    🚀</div>
                <h3 class="font-bold text-gray-800 mb-2">Muito Rápido</h3>
                <p class="text-sm text-gray-500">Redirecionamento otimizado para o máximo de velocidade.</p>
            </div>
            <div class="text-center p-6">
                <div
                    class="bg-indigo-100 text-indigo-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">
                    📱</div>
                <h3 class="font-bold text-gray-800 mb-2">QR Code Pronto</h3>
                <p class="text-sm text-gray-500">Baixe o QR Code para qualquer url na mesma hora.</p>
            </div>
            <div class="text-center p-6">
                <div
                    class="bg-indigo-100 text-indigo-600 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl">
                    📊</div>
                <h3 class="font-bold text-gray-800 mb-2">Estatísticas (Admin)</h3>
                <p class="text-sm text-gray-500">Logue para ver cliques em tempo real no dashboard.</p>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} LinkShort. Construído com Laravel 11.
            </p>
        </div>
    </footer>

    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("shortenedLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            navigator.clipboard.writeText(copyText.value);
            alert("Copiado para a área de transferência: " + copyText.value);
        }
    </script>
</body>

</html>