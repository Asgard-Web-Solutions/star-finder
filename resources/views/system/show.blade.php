@extends('site.layout')

@section('body')
    <div class="w-full">

        <div class="card w-4/12 m-auto">
            <div class="card-header">
                <h1>{{ $system->name }}</h1>
            </div>
            <div class="card-body">
                <strong>Name:</strong> {{ $system->name }}<br>
                <strong>Location:</strong> {{ $system->location->x }}, {{ $system->location->y }}<br />

                <br />
                <strong>Description:</strong> {{ $system->description}}<br />

                <div class="w-full text-right mr-2">
                    <a href="{{ route('edit-system', $system->id) }}" class="button">Edit System</a>
                </div>
            </div>
        </div>

        <br />
        <div class="card w-4/12 m-auto">
            <div class="card-header">
                <h1>{{ $system->name }} Planets</h1>
            </div>
            <div class="card-body">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>Planet Name</th>
                            <th>Distance</th>
                            <th>Size</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    @foreach($system->planets as $planet)
                        <tr>
                            <td>{{ $planet->name }}</td>
                            <td>{{ $planet->distance_from_star }} mkm</td>
                            <td>{{ $planet->size }} km</td>
                            <td>{{ $planet->type }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>


        <div class="text-right w-4/12 mt-2 m-auto">
            <a href="{{ route('locations') }}" class="button-dark">Go Back</a>
        </div>

    </div>
@endsection
