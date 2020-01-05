@extends('site.layout')

@section('body')
    <div class="card w-1/4">
        <div class="card-header">
            <h1>{{ $user->name }}</h1>
        </div>
        <div class="card-body">
            <strong>Name:</strong> {{ $user->name }}<br />
            <strong>Email:</strong> {{ $user->email }}<br />
            
            <div class="text-right w-full">
                <a href="{{ route('all-users') }}" class="button-dark">Go Back</a>
            </div>
        </div>
    </div>
@endsection