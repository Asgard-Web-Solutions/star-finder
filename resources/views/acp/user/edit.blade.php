@extends('site.layout')

@section('body')
    <div>
        <div class="card">
            <div class="card-header">
                <h1>Update User {{ $user->name }}</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('update-user', $user->id) }}" method="POST">
                    @csrf

                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-input" name="name" id="name" value="{{ $user->name }}"><br />

                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-input" name="email" id="email" value="{{ $user->email }}"><br />


                    <input type="submit" class="form-button" value="Update user">
                    <a href="{{ route('user', $user->id) }}" class="button-dark">Cancel</a>
                </form>
            </div>
        </div>

        @can('manage-roles')
            <br />
            <div class="card">
                <div class="card-header">
                    <h1>Manage Roles</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('add-user-role', $user->id) }}" method="post">
                        @csrf

                        <label for="role" class="form-label">Add Role</label>
                        <select name="role" id="role" class="form-input">
                            @forelse($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @empty
                                <option value="0" disabled>-- No Roles Available --</option>
                            @endforelse
                        </select>

                        <input type="submit" value="Add Role" class="form-button">
                    </form>

                    <br />
                    <h2 class="form-label">Remove Roles</h2>
                    <hr>
                    <table class="w-full mt-2">
                        @foreach ($user->roles as $role)
                            <tr>
                                <td><span class="role-tag bg-{{ $role->color_class }}">{{ $role->name }}</span></td>
                                <td><a href="{{ route('remove-user-role', ['user' => $user->id, 'role' => $role->id]) }}">Remove</a></td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        @endcan

    </div>
@endsection