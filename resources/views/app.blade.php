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
                    latestPets: '{{ route('api.pets.latest-pets') }}',
                    myPets: '{{ route('api.pets.my-pets') }}',
                    search: '{{ route('api.pets.search') }}',
                    store: '{{ route('api.pets.create') }}',
                    update: '{{ route('api.pets.update') }}',
                    delete: '{{ route('api.pets.delete') }}',
                },
                petType: {
                    all: '{{ route('api.pet-types.all') }}'
                },
                petColor: {
                    all: '{{ route('api.pet-colors.all') }}'
                },
                unsplashPhotoSearch: '{{ route('api.unsplash.search') }}'
            },
        }

        window.isLoggedIn = {{ \Illuminate\Support\Facades\Auth::check() ? 'true' : 'false' }};
    </script>
    @vite(['resources/js/app.js'])
</main>
</body>
</html>
