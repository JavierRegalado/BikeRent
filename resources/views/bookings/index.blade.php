<x-app-layout>

    <a href="{{ url('/') }}">Inicio</a>

    <div>
        @foreach ($bookings as $booking)
        <div>
            <p>Usuario: {{ $booking->user->name }}</p>
            <p>Bicicleta: {{ $booking->bike->model }}</p>
            <a  href="{{ route('booking.show', $booking) }}" class="text-blue-500 hover:underline">Ver detalles de la reserva</a>
        </div>
        @endforeach
    </div>
</x-app-layout>