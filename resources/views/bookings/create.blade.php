<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Registrar Préstamo</h1>
    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <input type="hidden" name="bike_id" value="{{ $bike->id }}">
        <div>
            <label for="start_time">Hora de Inicio:</label>
            <input type="datetime-local" name="start_time" id="start_time" required>
        </div>
        <div>
            <label for="end_time">Hora de Fin:</label>
            <input type="datetime-local" name="end_time" id="end_time" required>
        </div>
        <button type="submit">Registrar Préstamo</button>
</body>
</html>