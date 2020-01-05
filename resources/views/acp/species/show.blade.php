@extends('site.layout')

@section('body')
    <div class="card">
        <div class="card-header">
            <h1>{{ $species->name }}</h1>
        </div>
        <div class="card-body">
            <strong>Name:</strong> {{ $species->name }}
            
            <div class="text-right w-full">
                <a href="{{ route('all-species') }}" class="button-dark">Go Back</a>
            </div>
        </div>
    </div>
@endsection