<button class="m-1 @if (isset($color) && $color != "") {{ $color }} @else bg-gray-400 @endif @if (isset($colorHover) && $colorHover != "") {{ $colorHover }} @else hover:bg-gray-500 @endif text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
    {{ $slot }}
</button>
