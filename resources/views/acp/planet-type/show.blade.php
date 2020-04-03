@extends('site.layout')

@section('body')
    <div class="w-full">

        <div class="card w-4/12 m-auto">
            <div class="card-header">
                <h1>{{ $planet->type }}</h1>
            </div>
            <div class="card-body">
                <strong>Name:</strong> {{ $planet->type }}<br>
                <strong>diameter:</strong> {{ $planet->average_diameter}}<br>
                <strong>ore_multiplier:</strong> {{ $planet->ore_multiplier}}<br>
                <strong>ore type:</strong> {{ $planet->ore_type}}<br>
                <strong>gas_multiplier:</strong> {{ $planet->gas_multiplier}}<br>
                <strong>gas type:</strong> {{ $planet->gas_type}}<br>
                <strong>probobility:</strong> {{ $planet->probability}}

                <div class="w-full text-right mr-2">
                    <a href="{{ route('edit-planet-type', $planet->id) }}" class="button">Edit planet</a>
                </div>
            </div>
        </div>

        <div class="text-right w-4/12 mt-2 m-auto">
            <a href="{{ route('all-planet-types') }}" class="button-dark">Go Back</a>
        </div>

    </div>
@endsection
