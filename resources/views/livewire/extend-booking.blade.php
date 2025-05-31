<div>
    <h2>Perpanjang Booking</h2>

    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="submit">
        <div>
            <label for="newEndDate">Tanggal Akhir Baru:</label>
            <input type="date" wire:model="newEndDate" id="newEndDate">
            @error('newEndDate') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="paymentMethod">Metode Pembayaran:</label>
            <select wire:model="paymentMethod" id="paymentMethod">
                <option value="transfer">Transfer</option>
            </select>
            @error('paymentMethod') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Perpanjang Booking</button>
    </form>
</div>
