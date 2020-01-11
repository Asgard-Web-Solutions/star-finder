@extends('site.layout')

@section('body')
    <div class="flex-row w-full">
        <div class="card w-1/4 m-auto">
            <div class="card-header">
                <h1>{{ $user->name }}</h1>
            </div>
            <div class="card-body">
                <strong>Name:</strong> {{ $user->name }}<br />
                <strong>Email:</strong> {{ $user->email }}<br />
                <strong>Roles:</strong> 
                @foreach ($user->roles as $role)
                    <span class="role-tag bg-{{ $role->color_class }}">{{ $role->name }}</span>
                @endforeach

                <br />
                <div class="w-full text-right">
                    <a href="{{ route('edit-user', $user->id) }}" class="button">Edit</a>
                </div>
            </div>
        </div>

        <div class="w-1/4 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('all-users') }}" class="button-dark">Back to User List</a>
            </div>
        </div>
    </div>
@endsection