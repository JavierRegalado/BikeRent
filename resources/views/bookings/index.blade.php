<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach ($bookings as $booking)
        <div>
            <p>Usuario: {{ $booking->user->name }}</p>
            <p>Bicicleta: {{ $booking->bike->model }}</p>
            <p>Fecha de Inicio: {{ $booking->start_date }}</p>
            <p>Fecha de Fin: {{ $booking->end_date }}</p>
            <p>Precio Total: ${{ number_format($booking->total_cost, 2) }}</p>
        </div>
    @endforeach
</body>
</html>