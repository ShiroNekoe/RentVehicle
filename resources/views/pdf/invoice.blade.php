<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice Booking</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            background-color: #f3f4f6;
            color: #111827;
            margin: 40px;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #316783;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 28px;
            color: #316783;
            margin: 0;
        }

        .logo {
            width: 90px;
            height: auto;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #316783;
            border-bottom: 1px solid #d1d5db;
            padding-bottom: 5px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px 40px;
        }

        .info p {
            margin: 6px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f9fafb;
            color: #374151;
        }

        tr:nth-child(even) {
            background-color: #f3f4f6;
        }

        .total {
            font-weight: bold;
            font-size: 16px;
            color: #dc2626;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: #6b7280;
            border-top: 1px solid #d1d5db;
            padding-top: 10px;
        }

        .terms {
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .terms h3 {
            color: #316783;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .terms ul {
            list-style-type: none;
            padding: 0;
        }

        .terms li {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .button {
            background-color: #316783;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            text-align: center;
            border-radius: 5px;
            width: 100%;
            margin-top: 20px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #254e6d;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Invoice Booking</h1>
                <p><strong>ID Booking:</strong> {{ $booking->id }}</p>
                <p><strong>Booking Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p>
            </div>
            <div>

        </div>

        <div class="section">
            <div class="section-title">User Information</div>
            <div class="info-grid">
                <div class="info">
                    <p><strong>Name:</strong> {{ $booking->user->name ?? '-' }}</p>
                    <p><strong>Email:</strong> {{ $booking->user->email ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Booking Details</div>
            <div class="info-grid">
                <div class="info">
                    <p><strong>Vehicle Name:</strong> {{ $booking->vehicle->vehicle_name ?? '-' }}</p>
                    <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</p>
                    <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</p>
                    <p><strong>Duration:</strong> {{ $booking->duration_days }} days</p>
                    @php
                    use Carbon\Carbon;
                    $duration = Carbon::parse($booking->start_date)->diffInDays(Carbon::parse($booking->end_date));
                    @endphp
                    <p><strong>Duration:</strong> {{ $duration }} days</p>
                </div>

                <div class="info">
                    <p><strong>Pick Up Location:</strong> {{ $booking->pickup_location ?? '-' }}</p>
                <p><strong>Return Location:</strong>
                        @if($booking->return_option === 'showroom')
                            Showroom
                        @elseif($booking->return_option === 'other')
                            {{ $booking->return_location ?? '-' }}
                        @else
                            -
                        @endif
                    </p>

                    <p><strong>Driver:</strong> {{ $booking->use_driver ? 'Yes (+Rp125.000)' : 'No' }}</p>
                    <p><strong>Payment Method:</strong> {{ strtoupper($payment->payment_method ?? '-') }}</p>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Price Breakdown</div>
            <table>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
                <tr>
                    <td>Price Per Day</td>
                    <td>Rp{{ number_format($booking->vehicle->price ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Duration ({{ $duration }} days)</td>
                    <td>Rp{{ number_format(($booking->vehicle->price ?? 0) * $duration, 0, ',', '.') }}</td>
                </tr>
                @if($booking->driver->driver_name)
                    <tr>
                        <td>Driver</td>
                        <td>Rp125,000</td>
                    </tr>
                @endif
                <tr class="total">
                    <td>Total Price</td>
                    <td>Rp{{ number_format($booking->booking_price, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <!-- Terms and Conditions -->
        <div class="terms">
            <h3>Terms and Conditions</h3>
            <ul>
                <li><strong>Pickup/Return:</strong> Return the vehicle on time or face extra charges.</li>
                <li><strong>Driver:</strong> Must show valid ID.</li>
                <li><strong>Vehicle Condition:</strong> Return in the same condition. Damages will incur fees.</li>
                <li><strong>Extensions:</strong> Request before rental ends; additional charges apply.</li>
                <li><strong>Cancellation:</strong> 24 hours in advance, only half price refunded.</li>
                <li><strong>Liability:</strong> Renter is responsible for any fines or accidents.</li>
                <li><strong>Payment:</strong> Full payment required before rental starts.</li>
            </ul>
        </div>

        <div class="footer">
            <p>Thank you for using our service.<br>If you have any questions, please contact our customer service.</p>
        </div>
    </div>
</body>

</html>
