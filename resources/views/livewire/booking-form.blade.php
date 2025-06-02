<div class="min-h-screen flex justify-center items-center px-4 ">
    <div class="w-full max-w-4xl p-8 bg-white rounded-xl shadow-lg space-y-8">

        <h2 class="text-3xl font-bold text-center text-[#316783] mb-6">Booking Form</h2>

        @if(session()->has('error'))
            <div class="p-4 mb-4 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        @if($start_date && $end_date && $start_time && $end_time && $days <= 0)
         <div class="p-2 text-sm text-red-600 bg-red-100 rounded">
            The end date and time must be after the start date and time.
        </div>
         @endif


        <form wire:submit.prevent="submitBooking" class="space-y-6">
            <!-- Tanggal dan Waktu -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/3">
                    <label class="block text-sm font-semibold text-gray-700">Start Date</label>
                    <input type="date" wire:model="start_date" class="input input-bordered w-full rounded-md py-2 px-4 border-gray-300 focus:ring-[#316783] focus:border-[#316783]">
                    @error('start_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="w-full md:w-1/3">
                    <label class="block text-sm font-semibold text-gray-700">End Date</label>
                    <input type="date" wire:model="end_date" class="input input-bordered w-full rounded-md py-2 px-4 border-gray-300 focus:ring-[#316783] focus:border-[#316783]">
                   @error('end_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="w-full md:w-1/3">
                    <label class="block text-sm font-semibold text-gray-700">Start Time and End Time</label>
                    <input type="time" wire:model="start_time" class="input input-bordered w-full rounded-md py-2 px-4 border-gray-300 focus:ring-[#316783] focus:border-[#316783]">
                    @error('start_time') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Nomor HP dan Darurat -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block text-sm font-semibold text-gray-700">Personal Phone Number</label>
                    <input type="text" wire:model="phone_person" class="input input-bordered w-full rounded-md py-2 px-4 border-gray-300 focus:ring-[#316783] focus:border-[#316783]">
                    @error('phone_person') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="w-full md:w-1/2">
                    <label class="block text-sm font-semibold text-gray-700">Emergency Phone Number</label>
                    <input type="text" wire:model="phone_security" class="input input-bordered w-full rounded-md py-2 px-4 border-gray-300 focus:ring-[#316783] focus:border-[#316783]">
                    @error('phone_security') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- NIK and Identity Upload -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block text-sm font-semibold text-gray-700">NIK (16 digits)</label>
                    <input type="text" wire:model="nik_identity" class="input input-bordered w-full rounded-md py-2 px-4 border-gray-300 focus:ring-[#316783] focus:border-[#316783]">
                    @error('nik_identity') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="w-full md:w-1/2">
                    <label class="block text-sm font-semibold text-gray-700">Upload Identity (jpg/png/pdf)</label>
                    <input type="file" wire:model="identity" class="file-input file-input-bordered w-full rounded-md py-2 px-4 border-gray-300 focus:ring-[#316783] focus:border-[#316783]" accept=".jpg,.png,.pdf">
                    @error('identity') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

<!-- Pickup Location, Driver, and Return Location  -->
<div class="flex flex-col md:flex-row gap-4">
    <div class="w-full md:w-1/3 text-center">
        <label class="block text-sm font-semibold text-gray-700">Use a Driver?</label>
        <input type="checkbox" wire:model="use_driver" class="toggle toggle-primary">
        @if($use_driver)
            <div class="mt-2">
                <label class="block">Driver automatically selected (random)</label>
                <input type="text" value="Driver ID: {{ $id_driver }}" class="input input-bordered w-full rounded-md py-2 px-4 border-gray-300 focus:ring-[#316783] focus:border-[#316783]" disabled>
            </div>
        @endif
    </div>

    <div class="w-full md:w-1/3">
        <label class="block text-sm font-semibold text-gray-700">Return Method</label>
<select wire:model="return_option" class="select select-bordered w-full rounded-md py-2 px-4 border-gray-300 focus:ring-[#316783] focus:border-[#316783]">
    <option value="showroom">Return to showroom</option>
    <option value="other">Other location</option>
</select>
<p class="text-xs text-gray-500 mt-1 italic">Showroom location: Blok pasar mantong, Jl. Sunan Giri No.76, Sumber Taman, Kec. Wonoasih, Kota Probolinggo, Jawa Timur 67237.</p>
@if($return_option === 'other')
    <input type="text" wire:model="return_location" class="input input-bordered w-full mt-2 rounded-md py-2 px-4 border-gray-300 focus:ring-[#316783] focus:border-[#316783]" placeholder="Return location">
    <p class="text-xs text-gray-500 mt-1 italic">Return location must be in Probolinggo.</p>
    @error('return_location') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
@endif

    </div>
</div>

            <!-- Payment Method -->
            <div>
                <label class="block text-sm font-semibold text-gray-700">Payment Method</label>
                <select wire:model="payment_method" class="select select-bordered w-full rounded-md py-2 px-4 border-gray-300 focus:ring-[#316783] focus:border-[#316783]">
                    <option value="">Select Payment Method</option>
                    <option value="transfer">Bank Transfer</option>
                    <option value="cod">Cash on Delivery (COD)</option>
                </select>
                @error('payment_method') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>


<!-- Terms and Conditions Checkbox -->
<div class="mt-4">
  <label class="inline-flex items-center">
    <input type="checkbox" wire:model="acceptTerms" class="form-checkbox text-[#316783]" />
    <span class="ml-2 text-gray-700 text-sm">I agree to the <span class="font-semibold text-[#316783] cursor-pointer" @click="open = !open">Terms and Conditions</span></span>
  </label>
  @error('acceptTerms') <span class="text-red-600 text-sm block mt-1">{{ $message }}</span> @enderror
</div>

<!-- Terms and Conditions content toggle -->
<div x-data="{ open: false }" class="pt-2 bg-gray-50 mt-2">
  <h3 @click="open = !open" class="text-xl text-center font-semibold text-[#316783] cursor-pointer mb-2">
      Terms and Conditions
  </h3>
  <ul x-show="open" x-transition class="space-y-2 text-sm text-center">
      <li><strong>Pickup/Return:</strong> Return the vehicle on time or face extra charges.</li>
      <li><strong>Driver:</strong> Must show valid ID.</li>
      <li><strong>Vehicle Condition:</strong> Return in the same condition. Damages will incur fees.</li>
      <li><strong>Extensions:</strong> Request before rental ends; additional charges apply.</li>
      <li><strong>Cancellation:</strong> 24 hours in advance, only half price refunded.</li>
      <li><strong>Liability:</strong> Renter is responsible for any fines or accidents.</li>
      <li><strong>Payment:</strong> Full payment required before rental starts.</li>
  </ul>
</div>


            <!-- Total Days and Price -->
            <div class="p-4 bg-gray-100 rounded mt-4">
                <p><strong>Total Days:</strong> {{ $days }} days</p>
                <p><strong>Total Price:</strong> Rp{{ number_format($total_price, 0, ',', '.') }}</p>
            </div>


            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-warning py-3 px-6 rounded-md font-semibold text-white">
                    Book Now
                </button>
            </div>
        </form>
    </div>
</div>
