@extends('site.layout')

@section('body')
    <div class="w-full">
        <div class="card w-1/4 m-auto">
            <div class="card-header">
                <h1>{{ $role->name }}</h1>
            </div>
            <div class="card-body">
                <strong>Name:</strong> {{ $role->name }}<br />
                <strong>Color Class:</strong> {{ $role->color_class }}<br />

                <br /><strong>Tag Preview:</strong> <span class="role-tag bg-{{ $role->color_class }}">{{ $role->name }}</span>
                <br /><br />
                <div class="w-full text-right">
                    <a href="{{ route('edit-role', $role->id) }}" class="button">Edit Role</a>
                </div>
            </div>
        </div>

        <div class="w-1/4 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('all-roles') }}" class="button-dark">Go Back</a>
            </div>
        </div>

    </div>
@endsection
