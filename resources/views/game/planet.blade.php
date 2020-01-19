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
                <div class="card w-3/12 mr-2">
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
                            Level: {{ $base->level }}
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