<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/favicon.ico') }}">
    <title>Nautilus</title>
    <style>* {
            box-sizing: border-box
        }</style>
</head>
<body class="min-h-screen flex justify-between flex-col">
<div class="min-h-[75vh]">
    <x-header/>
    <main class="mx-auto max-w-[1440px] w-full p-4">
        {{ $slot }}
    </main>
</div>

<x-footer/>
</body>
</html>
