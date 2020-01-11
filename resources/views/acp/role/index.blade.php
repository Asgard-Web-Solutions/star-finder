@extends('site.layout')

@section('body')

    <div class="w-full">
        <div class="card w-3/12 m-auto">
            <div class="card-header">
                <h1>Manage Roles</h1>
            </div>
            <div class="card-body">
                <table class="p-2 w-full">
                    <thead>
                        <th>Name</th>
                        <th>Edit Role</th>
                    </thead>
                    @foreach ($roles as $role)
                        <tr>
                            <td><a href="{{ route('role', $role->id) }}" class="role-tag bg-{{ $role->color_class }}">{{ $role->name }}</a></td>
                            <td><a href="{{ route('edit-role', $role->id) }}">Edit</a></td>
                        </tr>
                    @endforeach
                </table>

                <br />
                <div class="w-full text-right">
                    <a href="{{ route('new-role') }}" class="button">Add Role</a>
                </div>

            </div>
        </div>

        <div class="w-3/12 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('acp') }}" class="button-dark">Back to ACP</a>
            </div>
        </div>
    </div>

@endsection
