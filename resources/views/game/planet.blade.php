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
            <div class="card sm:w-full md:w-5/12 lg:w-4/12">
                <div class="card-header">
                    <h1>Operations Summary</h1>
                </div>
                <div class="card-body">
                    Number of Bases: {{ $bases->count() }}<br />
                    <br />
                    Total {{ __('common.ore') }}: {{ $planet->ore }}<br />
                    Total {{ __('common.gas') }}: {{ $planet->gas }}<br />
                    <br />
                    Mining Speed: {{ config('game.time_per_extraction') }}<br />
                </div>
            </div>
        </div>

        <br />
        <div class="w-full flex">
            @foreach ($bases as $base)
                <br />
                <div class="card w-full lg:w-8/12 md:mr-1 lg:mr-2">
                    <div class="card-header">
                        <h1>Universal Base #{{ $base->id }}</h1>
                    </div>
                    <div class="card-body">
                        @if ($base->status == "constructing")
                            <div class="text-center w-full">
                                <span class="text-yellow-500"> &gt;&gt; Under Construction &lt;&lt; </span>
                            </div>
                        @endif

                        @if ($base->status != "constructing")
                            <h2>Level: {{ $base->level }}</h2>

                            <br />
                            <table class="w-full">
                                <tr>
                                    <td class="text-orange-400">{{ __('common.ore') }}</td>
                                    <td class="text-orange-400">{{ __('common.gas') }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $base->ore }} / {{ $base->maxStorage['ore'] }}
                                        @if ($base->level > 1)
                                            [<a href="{{ route('sell-materials', ['base' => $base->id, 'material' => 'ore']) }}">Sell</a>]
                                        @endif
                                    </td>
                                    <td>
                                        {{ $base->gas }} / {{ $base->maxStorage['gas'] }}
                                        @if ($base->level > 1)
                                            [<a href="{{ route('sell-materials', ['base' => $base->id, 'material' => 'gas']) }}">Sell</a>]
                                        @endif

                                    </td>
                                </tr>
                            </table>

                            @if ($base->status != "constructing")
                                <br />
                                <table class="w-full">
                                    <thead>
                                        <td class="text-orange-400">Facility</td>
                                        <td class="text-orange-400">Level</td>
                                        <td class="text-orange-400">Status</td>
                                    </thead>
                                    @foreach ($base->facilities as $facility)
                                        <tr>
                                            <td>{{ $facility->facility_type->name }}</td>
                                            <td>
                                                @if ($facility->status == "constructing" || $facility->status == "upgrading")
                                                    <span class="text-yellow-500">Under Construction</span>
                                                @else
                                                    {{ $facility->level }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('show-facility', $facility->id) }}"><i class="fas fa-cogs"></i></a>
                                                @if ($facility->full)
                                                    <span class="text-red-700"><i class="fas fa-power-off"></i></span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif

                            @if ($base->status == "upgrading")
                                <br />
                                <div class="text-center w-full">
                                    <span class="text-yellow-500"> &gt;&gt; Upgrade In Progress &lt;&lt; </span>
                                </div>
                            @endif

                            @if ($base->status == "completed")
                                <div class="w-full text-right mt-3">
                                    @if ($base->facilities->count() < $base->level )
                                        <a href="{{ route('new-facility', $base->id) }}" class="button">Build a Facility</a>
                                    @endif
                                    @if ($base->level < $base->max_level)
                                        <a href="{{ route('upgrade-base', $base->id) }}" class="button">Upgrade Base</a>
                                    @endif
                                </div>

                            @endif

                        @endif
                    </div>
                </div>
            @endforeach

            @if ($bases->count() < config('game.max_bases_per_planet') )
                <div class="card w-4/12 md:w-6/12">
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
