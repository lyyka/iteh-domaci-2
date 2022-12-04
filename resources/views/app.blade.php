<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pets App</title>
</head>
<body>
<main>
    <div id="app"></div>

    {{-- Defined global variables to be shared with the vue app --}}
    <script>
        window.appConfig = {
            api: {
                login: '{{ route('api.users.login') }}',
                register: '{{ route('api.users.register') }}',
                logout: '{{ route('api.users.logout') }}',
                pets: {
                    all: '{{ route('api.pets.all') }}',
                },
            },
        }

        window.isLoggedIn = {{ \Illuminate\Support\Facades\Auth::check() ? 'true' : 'false' }};
    </script>
    @vite(['resources/js/app.js'])
</main>
</body>
</html>