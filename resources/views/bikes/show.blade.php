<x-app-layout>
    <div>
        <h1>Detalles de la Bicicleta</h1>
        
        <a href="{{ route('bikes.index') }}">Volver al listado</a>
        <br>
        <a href="{{route('booking.create', ['bike' => $bike->id])}}" class="">Registrar Préstamo</a>

        <hr>

        <table>
            <tr>
                <th>ID:</th>
                <td>{{ $bike->id }}</td>
            </tr>
            <tr>
                <th>Número de Serie:</th>
                <td>{{ $bike->serial_number }}</td>
            </tr>
            <tr>
                <th>Modelo:</th>
                <td>{{ $bike->model }}</td>
            </tr>
            <tr>
                <th>Precio por Hora:</th>
                <td>${{ number_format($bike->price_per_hour, 2) }}</td>
            </tr>
            <tr>
                <th>Estado:</th>
                <td>{{ ucfirst($bike->status) }}</td>
            </tr>
            <tr>
                <th>Registrada el:</th>
                <td>{{ $bike->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th>Última actualización:</th>
                <td>{{ $bike->updated_at->format('d/m/Y H:i') }}</td>
            </tr>
        </table>
</x-app-layout>

