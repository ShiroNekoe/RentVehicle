@extends('layouts.app')

@section('content')
<div class="p-6 text-center">
    <h2 class="text-2xl font-semibold mb-4">Booking Berhasil Dibatalkan</h2>
    <p class="mb-4">Silakan hubungi admin untuk konfirmasi lebih lanjut.</p>
    <a href="https://wa.me/{{ $adminPhone }}" target="_blank" class="btn btn-success">
        Hubungi Admin via WhatsApp
    </a>
</div>
@endsection
