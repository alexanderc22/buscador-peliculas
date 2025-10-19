<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400">
            Mis Películas Favoritas 
        </h2>
    </x-slot>
    <div class="py-8 max-w-8xl mx-auto px-4">
        @if($favorites->isEmpty())
            <p class="text-gray-500">Aún no tienes películas favoritas.</p>
        @else
            <div class="grid grid-cols-1 gap-4">
                @foreach($favorites as $fav)
                    <div class="flex items-center bg-white shadow rounded-lg p-4">
                        <img src="{{ $fav->poster ?: 'https://via.placeholder.com/100x150?text=No+Image' }}" 
                             alt="{{ $fav->title }}" 
                             class="w-24 h-32 object-cover rounded mr-4">
                        <div>
                            <h3 class="text-lg font-bold">{{ $fav->title }}</h3>
                            <p class="text-gray-600">{{ $fav->year }}</p>

                            <form action="{{ route('favorites.destroy', $fav->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-600">
                                    X Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>