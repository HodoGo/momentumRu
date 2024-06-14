<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/0d8b715e25.js" crossorigin="anonymous"></script>
  <title>{{ $title ?? 'Laravel' }} | {{ config('app.name') }}</title>
  @vite('resources/css/app.css')
  @stack('style')
</head>

<body>
  {{ $slot }}
  @stack('script')
</body>

</html>
