@extends('site.layout')

@section('body')
    <div class="w-full">

        <div class="card w-4/12 m-auto">
            <div class="card-header">
                <h1>{{ $star->name }}</h1>
            </div>
            <div class="card-body">
                <strong>Name:</strong> {{ $star->name }}<br>
                <strong>diameter:</strong> {{ $star->diameter}}<br>
                <strong>color:</strong> {{ $star->color}}<br>
                <strong>probobility:</strong> {{ $star->probability}}

                <div class="w-full text-right mr-2">
                    <a href="{{ route('edit-star-type', $star->id) }}" class="button">Edit star</a>
                </div>
            </div>
        </div>

        <div class="text-right w-4/12 mt-2 m-auto">
            <a href="{{ route('all-star-types') }}" class="button-dark">Go Back</a>
        </div>

        <div class="card w-4/12 m-auto my-4">
            <div class="card-header">
                <h1>Zones</h1>
            </div>
            <div class="card-body">
                    <div class="flex">
                        <div class="w-3/12">Zone Number</div>
                        <div class="w-4/12">Miles From Star</div>
                        <div class="w-4/12">Number of Planets</div>
                        <div class="w-1/12">Edit</div>
                    </div>
                @foreach ($star->zones as $zone)
                    <div class="flex">
                        <div class="w-3/12"><a href="{{ route('zone-show', $zone->id) }}">Zone {{ $zone->order }}</a></div>
                        <div class="w-4/12">{{ $zone->distance }},000,000 Miles</div>
                        <div class="w-4/12">{{ $zone->planet_types->count() }}</div>
                        <div class="w-1/12"><a href="{{ route('zone-edit', $zone->id) }}">Edit</a></div>
                    </div>
                @endforeach

                <div class="w-full text-right mr-2 my-6">
                    <a href="{{ route('zone-add', $star->id) }}" class="button">Add Zone</a>
                </div>
            </div>
        </div>
    </div>

@endsection
