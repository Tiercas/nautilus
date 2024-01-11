<h1 class="mb-8 font-bold md:text-3xl lg:text-4xl underline underline-offset-4">{{ $slot }}</h1>
<script>
    document.title = document.title + " - " + "{{ $slot }}";
</script>
