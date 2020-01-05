@extends('site.layout')

@section('body')
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
                <a href="{{ route('all-users') }}" class="button-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection