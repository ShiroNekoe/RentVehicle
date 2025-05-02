<!-- resources/views/pages/transfer-confirmation.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg p-6 rounded-lg">
    <h2 class="text-xl font-semibold mb-4">Konfirmasi Pembayaran Transfer</h2>

    <p class="mb-2">Silakan transfer sebesar:</p>
    <p class="text-2xl font-bold text-green-600 mb-4">
        Rp{{ number_format($total_transfer, 0, ',', '.') }}
    </p>

    <p class="mb-2">Ke rekening berikut:</p>
    <ul class="list-disc pl-5 mb-4">
        <li>Bank: BCA</li>
        <li>Nomor Rekening: 1234567890</li>
        <li>Atas Nama: PT. Rental Kendaraan</li>
    </ul>

    <p class="mb-4 text-sm text-gray-600">Setelah melakukan transfer, silakan unggah bukti transfer hubungi admin untuk memverivikasi Pembayaran.</p>

    <a href="{{ route('dashboard') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md">
        Kembali ke Dashboard
    </a>
</div>
@endsection
