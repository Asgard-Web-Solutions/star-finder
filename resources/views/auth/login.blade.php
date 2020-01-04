@extends('site.layout')

@section('body')

<div class="bg-gray-800 rounded-b rounded-t-lg w-1/3 max-w-sm my-auto text-gray-100">
    <div class="bg-gray-300 text-blue-400 shadow-lg rounded-t w-full my-auto text-center">
        <h1 class="text-orange-600 text-2xl">Login</h1>
    </div>
    <form method="post" action="{{ route('login') }}">
        @csrf

        <label for="email" class="form-label">E-mail Address</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <label for="password" class="form-label">{{ __('Password') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="table-row">
            <label class="form-label" for="remember">Remember Me</label>
        
            <input class="form-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        </div>

        <button type="submit" class="form-button">
            Login
        </button>

        @if (Route::has('password.request'))
            <a class="form-button" href="{{ route('password.request') }}">Forgot Your Password?</a>
        @endif
    </form>

@endsection
