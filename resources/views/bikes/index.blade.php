<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Bikes') }}
        </h2>
    </x-slot>

    <a href="{{ url('/') }}">Inicio</a>

    <div class="">
        <div class="">
            <div class="">
                <div class="">
                    @foreach ($bikes as $bike)
                        <div class="">
                            <h3 class="">{{ $bike->model }}</h3>
                            <p>Precio por hora: ${{ $bike->price_per_hour }}</p>
                            <a href="{{ route('bikes.show', $bike) }}" class="">Ver Detalles</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>