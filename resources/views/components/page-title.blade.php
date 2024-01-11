<p style="font-size: 35px">{{ $slot }}</p>
<hr style="height: 3px;background-color: black;margin-bottom: 70px;margin-top: 5px; width : @if (isset($hrSize)){{$hrSize}}@else 100%@endif">
<script>
    document.title = document.title + " - " + "{{ $slot }}";
</script>