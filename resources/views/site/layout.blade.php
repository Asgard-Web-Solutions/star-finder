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
                    <a class="text-blue-500 hover:text-blue-800 no-underline" href="/">Home</a>
                </li>
                <li class="mr-6">
                    <a class="text-blue-500 hover:text-blue-800 no-underline" href="/home">Character</a>
                </li>
                @can('view-acp')
                    <li class="mr-6">
                        <a class="text-blue-500 hover:text-blue-800 no-underline" href="/acp">Admin Control Panel</a>
                    </li>
                @endcan
                @if (!Auth::check())
                    <li class="mr-6">
                        <a class="text-blue-500 hover:text-blue-800 no-underline" href="/login">Login</a>
                    </li>
                    <li class="mr-6">
                        <a class="text-blue-500 hover:text-blue-800 no-underline" href="/register">Register</a>
                    </li>
                @else
                    <li class="mr-6">
                        <a class="text-blue-500 hover:text-blue-800 no-underline" href="/logout">Logout</a>
                    </li>
                @endif
            </ul>
        </nav>

        @include('sweetalert::alert')

        @php
            $mainSize = "w-full";
        @endphp

        <div class="flex-row flex w-full">
            @if (isset($character))
                @php
                    $mainSize = "w-10/12";
                @endphp

                <aside class="bg-gray-100 w-2/12 min-h-full rounded-lg m-6 text-gray-900 p-3 font-spacey flex justify-center">
                    <div class="flex-row">
                        <div class="w-full text-center">
                            <h2 class="text-orange-600 text-2xl underline">Character</h2>
                        </div>

                        @if ($character == "none")
                            <a class="button" href="{{ route ('new-character') }}">create charater</a>
                        @else
                            <div class="mt-5">
                                <div class="card w-full">
                                    <div class="card-header">
                                    <h1>Your Character</h1>
                                    </div>
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </aside>
            @endif

            <main class="bg-gray-100 {{ $mainSize }} min-h-full rounded-lg m-6 text-gray-900 p-3 font-spacey flex justify-center">
                @yield('body')
            </main>
        </div>

    </body>
</html>
