@extends('site.layout')

@section('body')

    <div class="w-full">

        <div class="w-5/12 m-auto card md:w-6/12">
            <div class="card-header">
                <h1>Facility: {{ $facility->facility_type->name }}</h1>
            </div>
            <div class="card-body">
                Current Level: {{ $facility->level }}<br />

                @if ($facility->facility_type->type == "mine")
                    Mining Speed: {{ $facility->miningSpeed }} per Hour<br />
                    Mining Status:
                        @if ($facility->full)
                            <span class="text-red-700"><i class="fas fa-power-off"></i></span> <span class="text-xs">Storage Full</span>
                        @else
                            <span class="text-green-700"><i class="fas fa-power-off"></i></span>
                        @endif
                    <br />
                @endif

                @if ($facility->facility_type->type == "admin")
                    Contracts: {{ $facility->base->activeContracts->count() }} / {{ $facility->level }}<br />
                    <br />

                    <table class="w-full border-2">
                        <tr class="border-2">
                            <td class="p-2 border-2">Type</td>
                            <td class="p-2 border-2">Resource</td>
                            <td class="p-2 border-2">Price</td>
                            <td class="p-2 border-2">Amount</td>
                            <td class="p-2 border-2">Frequency</td>
                            <td class="p-2 border-2">Next Fulfillment</td>
                            <td class="p-2 border-2">Expires</td>
                        </tr>
                        @foreach ($facility->base->contracts as $contract)
                            <tr class="@if($contract->status == 'active') bg-blue-800 border-2 @else bg-gray-700 text-gray-500 @endif">
                                <td class="p-2 border-2">{{ Str::ucfirst($contract->action) }}</td>
                                <td class="p-2 border-2">{{ __('common.' . $contract->resource) }}</td>
                                <td class="p-2 border-2">{{ __('common.money symbol') }}{{ $contract->price }}</td>
                                <td class="p-2 border-2">{{ $contract->amount }}%</td>
                                <td class="p-2 border-2">{{ ($contract->frequency/60) }}m</td>
                                <td class="p-2 border-2">{{ $contract->next_at }}</td>
                                <td class="p-2 border-2">{{ $contract->expires_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <br />

                    @if ($facility->base->activeContracts->count() < $facility->level)
                        <div class="w-full text-right">
                            <a href="{{ route('create-contract', $facility->id) }}" class="button">Create Contract</a>
                        </div>
                    @endif
                    <br />
                @endif

                <br />


                <h2 class="text-orange-400">Upgrade Facility</h2>
                @if ($facility->level < $facility->base->level && $facility->status == "completed")
                    @php $canBuild = 0; @endphp
                    <table class="w-full">
                        <tr>
                            <td>{{ __('common.money') }}</td>
                            <td>{{ __('common.ore') }}</td>
                            <td>{{ __('common.gas') }}</td>
                        </tr>
                        <tr>
                            <td>
                                {{ __('common.money symbol') }}{{ $loadCharacter->money }} / {{ __('common.money symbol') }}{{ $facility->upgradeCost['money'] }}

                                @if ($facility->upgradeCost['money'] > $loadCharacter->money)
                                    <i class="text-red-500 fas fa-times-circle"></i>
                                @else
                                    <i class="text-green-500 far fa-check-circle"></i>
                                    @php $canBuild ++; @endphp
                                @endif

                            </td>
                            <td>{{ $facility->base->ore }} / {{ $facility->upgradeCost['ore'] }}

                                @if ($facility->upgradeCost['ore'] > $facility->base->ore)
                                    <i class="text-red-500 fas fa-times-circle"></i>
                                @else
                                    <i class="text-green-500 far fa-check-circle"></i>
                                    @php $canBuild ++; @endphp
                                @endif
                            </td>
                            <td>{{ $facility->base->gas }} / {{ $facility->upgradeCost['gas'] }}
                                @if ($facility->upgradeCost['gas'] > $facility->base->gas)
                                    <i class="text-red-500 fas fa-times-circle"></i>
                                @else
                                    <i class="text-green-500 far fa-check-circle"></i>
                                    @php $canBuild ++; @endphp
                                @endif
                            </td>
                        </tr>
                    </table>

                    @if ($canBuild == 3)
                        <form action="{{ route('upgrade-facility', $facility->id) }}" method="post">
                            @csrf

                            <input type="hidden" name="confirm" value="true">
                            <input type="submit" class="purchase-button" value="Start Construction">
                        </form>
                    @else
                        <br />
                        <div class="w-full text-center">
                            >> Not Enough Resources <<
                        </div>
                    @endif
                @else
                    @if ($facility->status != "completed")
                        Under Construction
                    @else
                        Max Level Reached
                    @endif
                @endif

            </div>
        </div>

        <div class="w-5/12 m-auto md:w-6/12">
            <div class="w-full my-3 text-right">
                <a href="{{ route('visit-planet') }}" class="button-dark">Cancel</a>
            </div>
        </div>
    </div>
@endsection
