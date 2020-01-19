@extends('site.layout')

@section('body')

    <div class="w-full">

        <div class="card w-3/12 m-auto">
            <div class="card-header">
                <h1>Base Construction</h1>
            </div>
            <div class="card-body">
                Current Bases on {{ $loadCharacter->planet->name }}: {{ $bases->count() }} / {{ config('game.max_bases_per_planet') }}<br />
                Cost: 
                    @if ( $loadCharacter->money < config('game.cost_new_base'))
                        {{ __('common.money symbol') }}<span class="text-red-700">{{ config('game.cost_new_base') }}</span>
                    @else
                        {{ __('common.money symbol') }}{{ config('game.cost_new_base') }}
                    @endif
                <br />

                <form action="{{ route('purchase-base') }}" method="post">
                    @csrf
    
                    <input type="hidden" name="planet" value="{{ $loadCharacter->planet_id }}">
                    <input type="submit" class="purchase-button" value="Start Construction">
                </form>
            </div>
        </div>

        <div class="w-1/4 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('visit-planet') }}" class="button-dark">Cancel</a>
            </div>
        </div>
    </div>
@endsection