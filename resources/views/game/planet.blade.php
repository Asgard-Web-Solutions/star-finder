@extends('site.layout')

@section('body')

    <div class="card w-3/12">
        <div class="card-header">
            <h1>Mining Operations</h1>
        </div>
        <div class="card-body">
            Bases: {{ $bases->count() }}
                @if ($bases->count() < config('game.max_bases_per_planet') )
                    <a href="{{ route('create-base') }}">Construct Base</a>
                @endif
        </div>
    </div>

@endsection