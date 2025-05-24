@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge([
        'class' => 'border-gray-300 focus:border-[#316783] focus:ring-[#316783] rounded-md shadow-sm'
    ]) }} 
/>
