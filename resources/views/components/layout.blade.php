<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
    <style>* {box-sizing: border-box}</style>
</head>
<body class="min-h-[100vh] flex justify-between flex-col">
  <x-header/>
  <main class="mx-auto max-w-[1028px] p-4 min-h-[80vh]">
    {{ $slot }}
  </main>
  <x-footer/>
</body>
</html>
