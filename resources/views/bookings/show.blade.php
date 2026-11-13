<x-app-layout>
    <h1>Detalles de la Reserva</h1>


    <a href="{{ route('booking.index') }}">Volver al listado</a>

    <div>
        <p>Usuario: {{ $booking->user->name }}</p>
        <p>Bicicleta: {{ $booking->bike->model }}</p>
        <p>Fecha de Inicio: {{ $booking->start_date }}</p>
        <p>Fecha de Fin: {{ $booking->end_date }}</p>
        <p>Precio Total: ${{ number_format($booking->total_cost, 2) }}</p>
        <p>Estado: {{$booking->status}}</p>
        @if ($booking->status === 'pending')
            <form action="{{ route('booking.cancel', $booking) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="">
                    Cancelar reserva
                </button>
            </form>
        @endif
    </div>
</x-app-layout>