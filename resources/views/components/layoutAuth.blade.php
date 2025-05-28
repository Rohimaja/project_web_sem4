<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{asset('images/stipress.png')}}">
  <title>{{ $title ?? 'Login' }} | STIPRES</title>
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
</head>
<body>

  <body class="antialiased bg-gray-100 font-sans">
    <main>
        {{ $slot }}
    </main>
</body>

</body>
</html>
