<x-layouts.app title="Extend Booking #{{ $booking->id }}">
    @livewire('booking-extend', ['booking' => $booking])
</x-layouts.app>
