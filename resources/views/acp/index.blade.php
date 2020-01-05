@extends('site.layout')

@section('body')
    <div class="card w-1/4">
        <div class="card-header">
            <h1>Game Elements</h1>
        </div>

        <div class="card-body">
            <table class="p-2 w-full">
                <thead>
                    <th>Game Element</th>
                    <th>Add</th>
                </thead>
                <tr>
                    <td class="pl-2"><a href="{{ route('all-species') }}">Species</a></td>
                    <td><a href="{{ route('new-species') }}">New</a></td>
                </tr>
            </table>
        </div>
    </div>
@endsection