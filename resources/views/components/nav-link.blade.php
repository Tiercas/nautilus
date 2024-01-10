@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-1 pt-1 border-b-[3px] border-[#FFBE55] hover:text-[#FFBE55] text-sm font-medium leading-5 text-[#EBEBEB] focus:outline-none focus:border-[#FFBE55] transition duration-150 ease-in-out'
                : 'inline-flex items-center px-1 pt-1 border-b-[3px] border-transparent hover:text-[#FFBE55] text-sm font-medium leading-5 text-[#EBEBEB] hover:border-[#FFBE55] focus:outline-none focus:text-[#FFBE55] focus:border-[#FFBE55] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
