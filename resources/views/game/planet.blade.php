@extends('site.layout')

@section('body')
    <div class="w-full">
        <div class="w-full">
            <h1 class="text-4xl">{{ $planet->name }}</h1>
            <p>
                List of {{ $loadCharacter->name }}'s operations on {{ $planet->name }}.
            </p>
        </div>

        <div class="w-full">
            <br />
            <div class="card w-3/12">
                <div class="card-header">
                    <h1>Operations Summary</h1>
                </div>
                <div class="card-body">
                    Number of Bases: {{ $bases->count() }}
                </div>
            </div>
        </div>

        <br />
        <div class="w-full flex">
            @foreach ($bases as $base)
                <br />
                <div class="card w-4/12 mr-2">
                    <div class="card-header">
                        <h1>Universal Base #{{ $base->id }}</h1>
                    </div>
                    <div class="card-body">
                        @if ($base->status == "constructing")
                            <div class="text-center w-full">
                                <span class="text-yellow-500"> &gt;&gt; Under Construction &lt;&lt; </span>
                            </div>
                        @endif

                        @if ($base->status == "completed")
                            <h2>Level: {{ $base->level }}</h2>

                            <table class="w-full">
                                <thead>
                                    <th>Facility</th>
                                    <th>Level</th>
                                </thead>
                                @foreach ($base->facilities as $facility)
                                    <tr>
                                        <td>{{ $facility->facility_type->name }}</td>
                                        <td>
                                            @if ($facility->status == "constructing")
                                                <span class="text-yellow-500">Under Construction</span>
                                            @else
                                                {{ $facility->level }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <div class="w-full text-right mt-3">
                                @if ($base->facilities->count() < $base->level )
                                    <a href="{{ route('new-facility', $base->id) }}" class="button">Build a Facility</a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            @if ($bases->count() < config('game.max_bases_per_planet') )
                <div class="card w-3/12">
                    <div class="card-header">
                        <h1>Base Availability</h1>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('create-base') }}">Construct This Base</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection