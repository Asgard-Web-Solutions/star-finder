@extends('site.layout')

@section('body')

    <div class="flex-row w-full">
        <div class="card w-5/12 m-auto">
            <div class="card-header">
                <h1>Manage Users</h1>
            </div>
            <div class="card-body text-center">
                <table class="p-2 w-full">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Edit Users</th>
                    </thead>
                    @foreach ($users as $user)
                        <tr>
                            <td><a href="{{ route('user', $user->id) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td><a href="{{ route('edit-user', $user->id) }}">Edit</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>    
        </div>

        <div class="w-4/12 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('acp') }}" class="button-dark">Back to ACP</a>
            </div>
        </div>
    </div>

@endsection