@extends('site.layout')

@section('body')

    <div class="w-full">

        <div class="card w-1/4 m-auto">
            <div class="card-header">
                <h1>{{ $zone->star_type->name }} Zone {{ $zone->order }}</h1>
            </div>
            <div class="card-body">
                <div class="flex">
                    <div class="w-1/3 font-bold">Planet Type</div>
                    <div class="w-1/3 font-bold">Probability</div>
                    <div class="w-1/4 font-bold">Actions</div>
                </div>
                @foreach ($zone->planet_types as $planet)
                    <div class="flex">
                        <div class="w-1/3">{{ $planet->type }}</div>
                        <div class="w-1/3">{{ $planet->pivot->probability }}%</div>
                        <div class="w-1/4">
                            <a href="{{ route('zone-planet-delete', ['id' => $zone->id, 'planet_id' => $planet->id]) }}"><i class="far fa-trash-alt"></i></a>
                        </div>
                    </div>
                @endforeach
                <hr class="border-orange-200 my-3">
                <div class="flex">
                    <div class="w-1/3">Total Probability</div>
                    <div class="w-1/3">{{ $zone->probability }}%</div>
                </div>

                <div class="w-full text-right my-4">
                    <a href="{{ route('zone-planet-add', $zone->id) }}" class="button">Add Planet Type</a>
                </div>
            </div>
        </div>

        <div class="text-right my-4 w-1/4 m-auto">
            <a href="{{ route('acp-star-type', $zone->star_type->id) }}" class="button-dark">Cancel</a>
        </div>
    </div>
@endsection