<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body>
    <h1>Invoice Booking</h1>
    <p>Booking ID: {{ $booking->id }}</p>
    <p>User: {{ $user->name }}</p>
    <p>Vehicle: {{ $vehicle->name }}</p>
    <p>Total Price: Rp{{ number_format($booking->total_price, 0, ',', '.') }}</p>
</body>
</html>
