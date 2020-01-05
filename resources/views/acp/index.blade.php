@extends('site.layout')

@section('body')


    <div class="card w-2/12 mr-3 h-32">
        <div class="card-header">
            <h1>Manage Site</h1>
        </div>

        <div class="card-body text-center">

            <ul>
                <li><a href="{{ route('all-users') }}">Users</a></li>
                <li><a href="{{ route('all-roles') }}">Roles</a></li>
            </ul>

        </div>
    </div>

    <div class="card w-2/12 h-32">
        <div class="card-header">
            <h1>Game Elements</h1>
        </div>

        <div class="card-body text-center">

            <ul>
                <li><a href="{{ route('all-species') }}">Species</a></li>
            </ul>
        </div>
    </div>

@endsection