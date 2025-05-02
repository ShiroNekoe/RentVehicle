@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg p-8 rounded-lg border-2 border-gray-100">
    <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Konfirmasi Pembayaran Transfer</h2>

    <div class="bg-gray-50 p-6 rounded-lg mb-6">
        <h3 class="text-lg font-medium text-gray-800">Jumlah yang Harus Ditransfer:</h3>
        <p class="text-3xl font-bold text-green-600 mt-2">
            Rp{{ number_format($total_transfer, 0, ',', '.') }}
        </p>
    </div>

    <div class="bg-gray-50 p-6 rounded-lg mb-6">
        <h3 class="text-lg font-medium text-gray-800">Detail Rekening Tujuan:</h3>
        <ul class="list-disc pl-5 mt-3 text-gray-700">
            <li><strong>Bank:</strong> BCA</li>
            <li><strong>Nomor Rekening:</strong> 1234567890</li>
            <li><strong>Atas Nama:</strong> PT. Rental Kendaraan</li>
        </ul>
    </div>

    <div class="bg-gray-50 p-6 rounded-lg mb-6">
        <h3 class="text-lg font-medium text-gray-800">Petunjuk Pembayaran:</h3>
        <p class="text-sm text-gray-600 mt-3">
            Setelah melakukan transfer, unggah bukti transfer Anda dan hubungi admin untuk verifikasi pembayaran.
        </p>
        <p class="text-sm text-gray-600 mt-2">Hubungi nomor admin: <span class="font-semibold">012837213</span></p>
    </div>

    <div class="text-center">
        <a href="{{ route('user.dashboard') }}" class="inline-block bg-blue-500 text-black px-6 py-3 rounded-md text-lg font-medium hover:bg-blue-600 transition">
            Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
