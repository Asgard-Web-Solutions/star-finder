@extends('site.layout')

@section('body')

    <div class="card w-2/12 mr-3">
        <div class="card-header">
            <h1>Manage Site</h1>
        </div>

        <div class="card-body text-center">
            <table class="m-auto">
                <thead>
                    <th>Site Elements</th>
                </thead>
                <tr>
                    <td><a href="{{ route('all-users') }}">Manage Users</a></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card w-2/12">
        <div class="card-header">
            <h1>Game Elements</h1>
        </div>

        <div class="card-body">
            <table class="m-auto">
                <thead>
                    <th>Game Element</th>
                </thead>
                <tr>
                    <td><a href="{{ route('all-species') }}">Species</a></td>
                </tr>
            </table>
        </div>
    </div>
@endsection