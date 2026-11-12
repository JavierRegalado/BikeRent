<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Registrar Préstamo</h1>
    @if ($errors->any())
    <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <input type="hidden" name="bike_id" value="{{ $bike->id }}">
        <div>
            <label for="start_date">Fecha de Inicio:</label>
            <input type="datetime-local" name="start_date" id="start_date" required>
        </div>
        <div>
            <label for="end_date">Fecha de Fin:</label>
            <input type="datetime-local" name="end_date" id="end_date" required>
        </div>
        <button type="submit">Registrar Préstamo</button>
</body>
</html>