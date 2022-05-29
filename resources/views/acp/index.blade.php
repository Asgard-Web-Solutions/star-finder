@extends('site.layout')

@section('body')


    <div class="w-2/12 h-32 m-2 card">
        <div class="card-header">
            <h1>Manage Site</h1>
        </div>

        <div class="text-center card-body">

            <ul>
                @can('view-acp-users')<li><a href="{{ route('all-users') }}">Users</a></li>@endcan
                @can('manage-roles')<li><a href="{{ route('all-roles') }}">Roles</a></li>@endcan
            </ul>

        </div>
    </div>


    @can('manage-game-elements')
        <div class="w-2/12 m-2 card">
            <div class="card-header">
                <h1>Game Elements</h1>
            </div>

            <div class="text-center card-body">

                <ul>
                    <li><a href="{{ route('all-species') }}">Species</a></li>
                    <li><a href="{{ route('locations') }}">Locations</a></li>
                    <li><a href="{{ route('all-star-types') }}">Star-types</a></li>
                    <li><a href="{{ route('all-planet-types') }}">planet-types</a></li>
                    <li><a href="{{ route('all-ship-types') }}">Ship Types</a></li>
                </ul>
            </div>
        </div>
    @endcan

    @can('manage-characters')
        <div class="w-2/12 h-32 m-2 card">
            <div class="card-header">
                <h1>Player Elements</h1>
            </div>

            <div class="text-center card-body">

                <ul>
                    <li><a href="{{ route('all-characters') }}">Characters</a></li>
                    <li><a href="{{ route('all-actions') }}">Actions</a></li>
                    <li><a href="{{ route('all-bases') }}">Bases</a></li>
                </ul>
            </div>
        </div>
    @endcan

@endsection
