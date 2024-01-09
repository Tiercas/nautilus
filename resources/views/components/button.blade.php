<button class="m-1 @if (isset($color) && $color != "") {{ $color }} @else bg-gray-300 @endif hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
    {{ $slot }}
</button>
