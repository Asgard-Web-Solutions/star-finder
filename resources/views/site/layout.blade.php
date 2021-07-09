<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nova+Square|Teko&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <script src="https://kit.fontawesome.com/96570d91e6.js" crossorigin="anonymous"></script>

        <title>@yield('title')</title>
    </head>
    <body class="bg-gray-900">

        <nav class="bg-gray-100 h-12 font-spacey flex text-xl">
            <ul class="flex h-full pt-3 pl-3">
                <li class="mr-6">
                    <a class="text-blue-500 hover:text-blue-800 no-underline" href="/">Home</a>
                </li>
                <li class="mr-6">
                    <a class="text-blue-500 hover:text-blue-800 no-underline" href="/home">Play</a>
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

        <div class="md:flex-row md:flex w-full">
            @if (isset($loadCharacter))
                @php
                    $mainSize = "w-full md:w-10/12";
                    $character = $loadCharacter;
                @endphp

                <aside class="bg-gray-100 w-full md:w-4/12 lg:w-3/12 xl:w-2/12 md:min-h-full rounded-lg mt-1 md:m-6 text-gray-900 p-3 font-spacey flex justify-center">
                    <div class="w-full">
                        <div class="w-full text-center">
                            <h2 class="text-orange-600 text-2xl underline">Character</h2>
                        </div>

                        <div class="mt-5 w-full xl:w-10/12 m-auto">
                            <div class="card w-full">
                                <div class="card-header">
                                <h1>{{ $character->name }}</h1>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li> Species: {{ $character->species->name }} </li>
                                        <li> {{ __('common.money') }}: {{ __('common.money symbol') }}{{ $character->money }}</li>
                                        <li> Research Points: {{ $character->research_points }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 w-full xl:w-10/12 m-auto">
                            <div class="card w-full">
                                <div class="card-header">
                                <h1>Location</h1>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li> System: {{ $character->planet->system->name }}</li>
                                        <li> Planet: {{ $character->planet->name }} </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 w-full xl:w-10/12 m-auto">
                            <div class="card w-full">
                                <div class="card-header">
                                <h1>In Progress</h1>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        @foreach ($character->actions as $action)
                                            <li class="text-sm">
                                                {{ $action->title }}
                                                <br />{{ $action->finishes_at }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            @endif

            <main class="bg-gray-100 {{ $mainSize }} min-h-full rounded-lg mt-1 md:m-6 text-gray-900 p-3 font-spacey flex justify-center">
                @yield('body')
            </main>
        </div>

    </body>
</html>
