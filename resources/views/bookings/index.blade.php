<a href="{{ url('/') }}">Inicio</a>

    <div>
        @foreach ($bookings as $booking)
        <div>
            <p>Usuario: {{ $booking->user->name }}</p>
            <p>Bicicleta: {{ $booking->bike->model }}</p>
            <a  href="{{ route('booking.show', $booking) }}" class="">Ver detalles de la reserva</a>
        </div>
        @endforeach
    </div>
