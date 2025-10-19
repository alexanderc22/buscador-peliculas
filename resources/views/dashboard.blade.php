<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400">
            Buscador de Películas
        </h2>
    </x-slot>

    <div class="py-8 max-w-8xl mx-auto px-4">
        <form method="GET" action="{{ route('movies.search') }}" class="mb-6 flex flex-col sm:flex-row items-center gap-4">
            <div class="flex">
                <input 
                    type="text" 
                    name="query" 
                    value="{{ request('query') }}" 
                    placeholder="Buscar película..." 
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"
                    required
                >  
                <input 
                    type="number" 
                    name="year" 
                    value="{{ request('year') }}" 
                    placeholder="Año" 
                    class="px-4 py-2 border rounded-lg w-32 text-center"
                    min="1900" max="{{ date('Y') }}"
                >  
                <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
                Buscar
            </button>
            </div>
            
        </form>

        @if(!empty($movies))
            <div class="grid grid-cols-1 gap-4">
                @foreach($movies as $movie)
                    <div class="flex items-center bg-white shadow rounded-lg p-4">
                        <img src="{{ $movie['Poster'] !== 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/100x150?text=No+Image' }}" 
                            alt="{{ $movie['Title'] }}" 
                            class="w-24 h-32 object-cover rounded mr-4">
                        <div>
                            <h3 class="text-lg font-bold">Titulo:  {{ $movie['Title'] }}</h3>
                            <p class="text-gray-600">Año: {{ $movie['Year'] }}</p>
                            <p class="text-gray-600">Tipo: {{ ucfirst($movie['Type']) }}</p>
                            <a 
                                href="https://www.imdb.com/title/{{ $movie['imdbID'] }}" 
                                target="_blank" 
                                class="mt-2 inline-block text-blue-600 hover:underline text-sm"
                            >
                                Ver en IMDb
                            </a>
                            <form action="{{ route('favorites.store') }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="imdb_id" value="{{ $movie['imdbID'] }}">
                                <input type="hidden" name="title" value="{{ $movie['Title'] }}">
                                <input type="hidden" name="year" value="{{ $movie['Year'] }}">
                                <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">
                                <button type="submit" class="bg-gray-800 text-white px-3 py-1 rounded hover:bg-gray-600">
                                    + Agregar a favoritos
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- 🔹 Paginación --}}
            @php
                $totalPages = ceil($totalResults / $perPage);
            @endphp

            @if($totalPages > 1)
                <div class="flex justify-center items-center mt-6 space-x-2">
                    {{-- Botón Anterior --}}
                    @if($page > 1)
                        <a href="{{ route('movies.search', ['query' => $query, 'year' => $year, 'page' => $page - 1]) }}"
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                        « Anterior
                        </a>
                    @endif

                    {{-- Páginas --}}
                    <span class="px-3 py-2 text-gray-700">
                        Página {{ $page }} de {{ $totalPages }}
                    </span>

                    {{-- Botón Siguiente --}}
                    @if($page < $totalPages)
                        <a href="{{ route('movies.search', ['query' => $query, 'year' => $year, 'page' => $page + 1]) }}"
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                        Siguiente »
                        </a>
                    @endif
                </div>
            @endif
        @endif

    </div>
</x-app-layout>
