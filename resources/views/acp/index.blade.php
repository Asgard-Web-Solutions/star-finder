@extends('site.layout')

@section('body')


    <div class="card w-2/12 m-2 h-32">
        <div class="card-header">
            <h1>Manage Site</h1>
        </div>

        <div class="card-body text-center">

            <ul>
                @can('view-acp-users')<li><a href="{{ route('all-users') }}">Users</a></li>@endcan
                @can('manage-roles')<li><a href="{{ route('all-roles') }}">Roles</a></li>@endcan
            </ul>

        </div>
    </div>


    @can('manage-game-elements')
        <div class="card w-2/12 m-2">
            <div class="card-header">
                <h1>Game Elements</h1>
            </div>

            <div class="card-body text-center">

                <ul>
                    <li><a href="{{ route('all-species') }}">Species</a></li>
                    <li><a href="{{ route('locations') }}">Locations</a></li>
                    <li><a href="{{ route('all-star-types') }}">Star Types</a></li>
                    <li><a href="{{ route('all-planet-types') }}">Planet Types</a></li>
                </ul>
            </div>
        </div>
    @endcan

    @can('manage-characters')
        <div class="card w-2/12 h-32 m-2">
            <div class="card-header">
                <h1>Player Elements</h1>
            </div>

            <div class="card-body text-center">

                <ul>
                    <li><a href="{{ route('all-characters') }}">Characters</a></li>
                    <li><a href="{{ route('all-actions') }}">Actions</a></li>
                    <li><a href="{{ route('all-bases') }}">Bases</a></li>
                </ul>
            </div>
        </div>
    @endcan

@endsection
