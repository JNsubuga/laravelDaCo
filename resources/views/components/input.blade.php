@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm my-0 h-8 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indingo-200 focus:ring-opcity-50']) !!}>