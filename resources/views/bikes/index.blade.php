<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bikes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($bikes as $bike)
                        <div class="mb-4 p-4 border rounded shadow">
                            <h3 class="text-lg font-semibold">{{ $bike->model }}</h3>
                            <p>Precio por hora: ${{ $bike->price_per_hour }}</p>
                            <a href="{{ route('bikes.show', $bike) }}" class="text-blue-500 hover:underline">Ver Detalles</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>