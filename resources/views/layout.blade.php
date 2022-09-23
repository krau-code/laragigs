<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" />

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />

    {{-- Alpine JS --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>

    <title>LaraGigs | @yield('title') </title>
</head>
<body class="mb-48">
    {{-- Navigation --}}
    <nav class="flex justify-between items-center mb-4">
        {{-- Logo --}}
        <a href="/">
            <img class="w-24" src="{{ asset('images/logo.png') }}" alt="" class="logo"/>
        </a>

        {{-- Links --}}
        <ul class="flex space-x-6 mr-6 text-lg">
            @auth
                {{-- Welcome --}}
                <li>
                    <span class="font-bold uppercase">
                        Welcome {{ auth()->user()->name }}
                    </span>
                </li>

                {{-- Manage Listings --}}
                <li>
                    <a href="/listings/manage" class="hover:text-laravel">
                        <i class="fa-solid fa-gear"></i> Manage Listings
                    </a>
                </li>

                {{-- Logout --}}
                <li>
                    <form class="inline" method="POST" action="/logout">
                        @csrf

                        <button type="submit" class="hover:text-laravel">
                            <i class="fa-solid fa-door-closed"></i> Logout
                        </button>
                    </form>
                </li>
            @else
                {{-- Register --}}
                <li>
                    <a href="/register" class="hover:text-laravel">
                        <i class="fa-solid fa-user-plus"></i> Register
                    </a>
                </li>

                {{-- Login --}}
                <li>
                    <a href="/login" class="hover:text-laravel">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                    </a>
                </li>
            @endauth
        </ul>
    </nav>

    {{-- Main Content --}}
    <main>
        {{-- View Output --}}
        @yield('content')
    </main>
    
    {{-- Footer --}}
    <footer class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center">
        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

        <a href="/listings/create" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">
            Post Job
        </a>
    </footer>

    {{-- Message --}}
    <x-flash-message />
</body>
</html>