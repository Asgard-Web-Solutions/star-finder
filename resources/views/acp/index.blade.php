@extends('site.layout')

@section('body')


    <div class="card w-2/12 mr-3 h-32">
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
        <div class="card w-2/12 h-32">
            <div class="card-header">
                <h1>Game Elements</h1>
            </div>

            <div class="card-body text-center">

                <ul>
                    <li><a href="{{ route('all-species') }}">Species</a></li>
                    <li><a href="{{ route('locations') }}">Locations</a></li>
                </ul>
            </div>
        </div>
    @endcan

@endsection