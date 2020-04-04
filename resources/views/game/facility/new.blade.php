@extends('site.layout')

@section('body')

    <div class="w-full">

        <div class="card w-7/12 m-auto">
            <div class="card-header">
                <h1>Facility Construction</h1>
            </div>
            <div class="card-body">
                Current Facilities on Base: {{ $base->facilities->count() }} / {{ $base->level }}<br />
                <br />
                <h2 class="text-orange-500 text-lg">Available Facilities</h2>
                <br />
                <table class="w-full">
                    <thead>
                        <td>Name</td>
                        <td>{{ __('common.money') }}</td>
                        <td>{{ __('common.ore') }}</td>
                        <td>{{ __('common.gas') }}</td>
                        <td>Build</td>
                    </thead>
                    @foreach ($facilities as $i => $facility)
                        @if ($loop->iteration % 2 == 0)
                            <tr class="bg-gray-600">
                        @else
                            <tr class="bg-gray-700">
                        @endif
                            <td class="p-2">{{ $facility->name }}</td>
                            <td>
                                {{ __('common.money symbol') }}{{ $facility->cost['money'] }}

                                @if ($facility->cost['money'] > $loadCharacter->money)
                                    <i class="fas fa-times-circle text-red-500"></i>
                                @else
                                    <i class="far fa-check-circle text-green-500"></i>
                                @endif

                            </td>
                            <td>{{ $facility->cost['ore'] }}
                                @if ($facility->cost['ore'] > $base->ore)
                                    <i class="fas fa-times-circle text-red-500"></i>
                                @else
                                    <i class="far fa-check-circle text-green-500"></i>
                                @endif
                            </td>
                            <td>{{ $facility->cost['gas'] }}
                                @if ($facility->cost['gas'] > $base->gas)
                                    <i class="fas fa-times-circle text-red-500"></i>
                                @else
                                    <i class="far fa-check-circle text-green-500"></i>
                                @endif
                            </td>
                            <td>
                                @if ($base->level == 2 && $facility->name == "Titanium Mine")
                                    <span class="text-gray-500">Limit Reached</span>
                                @elseif ($facility->learned)
                                    <a href="{{ route('create-facility', ['id' => $base->id, 'build' => $facility->id]) }}" class="button">Build</a>
                                @else
                                    <span class="text-gray-500">Not Yet Learned</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="w-7/12 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('visit-planet') }}" class="button-dark">Cancel</a>
            </div>
        </div>
    </div>
@endsection
