@extends('site.layout')

@section('body')

    <div class="bg-gray-800 rounded-b rounded-t-lg w-1/3 max-w-sm my-auto text-gray-100">
        <div class="bg-gray-300 text-blue-400 shadow-lg rounded-t w-full my-auto text-center">
            <h1 class="text-orange-600 text-2xl">Register</h1>
        </div>
        <form method="post" action="{{ route('register') }}">
            @csrf
            <label for="name" class="form-label">Name</label>
            <div>
                <input id="name" type="text" class="form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus><br />
                @error('name')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <label for="email" class="form-label">Email</label>
            <div>
                <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"><br />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <label for="password" class="form-label">Password</label>
            <div>
                <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"><br />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <label for="password-confirm" class="form-label">Confirm Password</label>
            <div>
                <input id="password-confirm" type="password" class="form-input" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="w-full text-center">
                <input type="submit" class="form-button" value="Register Account">
            </div>

        </form>
    </div>

@endsection
