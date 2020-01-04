<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nova+Square|Teko&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>@yield('title')</title>
    </head>
    <body class="bg-gray-900">

        <nav class="bg-gray-100 h-12 font-spacey flex text-xl">
            <ul class="flex h-full pt-3 pl-3">
                <li class="mr-6">
                    <a class="text-blue-500 hover:text-blue-800" href="#">Home</a>
                </li>
                <li class="mr-6">
                <a class="text-blue-500 hover:text-blue-800" href="#">Character</a>
                </li>
                @if (!Auth::check())
                    <li class="mr-6">
                        <a class="text-blue-500 hover:text-blue-800" href="/login">Login</a>
                    </li>
                    <li class="mr-6">
                        <a class="text-blue-500 hover:text-blue-800" href="/register">Register</a>
                    </li>
                @else
                    <li class="mr-6">
                        <a class="text-blue-500 hover:text-blue-800" href="/logout">Logout</a>
                    </li>                
                @endif
            </ul>
        </nav>

        <aside>

        </aside>

        <main class="bg-gray-100 w11/12 min-h-full rounded-lg m-6 text-gray-900 p-3 font-spacey flex justify-center">
            @yield('body')
        </main>

    </body>
</html>
