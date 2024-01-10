<a href="{{ $link }}">
    <div class="btn btn-primary flex flex-col justify-center items-center @if ($bgColor != null) {{ $bgColor }} @else bg-blue-700 @endif rounded-lg w-[10rem] h-[10rem] shadow">
       {{ $slot }}
            <p class="@if ($textColor != null) {{ $textColor }} @else text-white @endif text-center">{{ $textSubtitle }}</p>
    </div>
</a>
