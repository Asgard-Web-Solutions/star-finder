@extends('site.layout')

@section('body')

    <div class="w-full">

        <div class="card w-5/12 md:w-6/12 m-auto">
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
                    Contracts: {{ $facility->base->contracts->count() }} / {{ $facility->level }}<br />
                    <br />

                    <table class="w-full border-2">
                        <tr class="border-2">
                            <td class="border-2 p-2">Type</td>
                            <td class="border-2 p-2">Resource</td>
                            <td class="border-2 p-2">Price</td>
                            <td class="border-2 p-2">Amount</td>
                            <td class="border-2 p-2">Frequency</td>
                            <td class="border-2 p-2">Next Action</td>
                            <td class="border-2 p-2">Expires</td>
                        </tr>
                        <?php $activeContracts = 0; ?>
                        @foreach ($facility->base->contracts as $contract)
                            <tr class="border-2 bg-blue-800">
                                <td class="border-2 p-2">{{ $contract->action }}</td>
                                <td class="border-2 p-2">{{ __('common.' . $contract->resource) }}</td>
                                <td class="border-2 p-2">{{ __('common.money symbol') }}{{ $contract->price }}</td>
                                <td class="border-2 p-2">{{ $contract->amount }}%</td>
                                <td class="border-2 p-2">{{ ($contract->frequency/60) }}m</td>
                                @if ($contract->status == "active")
                                    <?php $activeContracts ++; ?>

                                    <td class="border-2 p-2">{{ $contract->next_at }}</td>
                                    <td class="border-2 p-2">{{ $contract->expires_at }}</td>
                                @else
                                    <td class="border-2 p-2">--</td>
                                    <td class="border-2 p-2">{{ ucfirst($contract->status) }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                    <br />

                    @if ($activeContracts < $facility->level)
                        <div class="w-full text-right">
                            <a href="{{ route('create-contract', $facility->id) }}" class="button">Create Contract</a>
                        </div>
                    @endif
                    <br />
                @endif

                @if ($facility->facility_type->type == "starport")
                    <div class="flex">
                        <div class="w-1/2">Currently Researching: 
                            @if($researching) 
                                <span class="text-orange-500">{{ $researching->name }}</span></div>
                                <div class="w-1/2">Progress: {{ $facility->research_progress }} / {{ $researching->research_points }} 
                            @else 
                                <span class="text-gray-600 text-sm">No Current Research Projects</span> 
                            @endif
                        </div>
                    </div>
                    <br />

                    <h2 class="text-orange-500 text-lg text-center">Research Starship Plans</h2>

                    <table class="w-7/12 m-auto">
                        <tr class="">
                            <td class="p-2">Ship</td>
                            <td class="p-2">Research Cost</td>
                            <td class="p-2">Action</td>
                        </tr>

                        @if ($plans)
                            @foreach ($plans as $plan)
                                <tr class="">
                                    <td class="p-2">{{ $plan->name }}</td>
                                    <td class="p-2"><strong class="text-orange-500">{{ $plan->research_points }}</strong> Research Point</td>
                                    <td class="p-2">
                                        @if ($plan->id == $facility->researching)
                                            <span class="text-gray-600 text-sm">Researching...</span>
                                        @else
                                            <a href="{{ route('research-plan', ['id' => $facility->id, 'plan' => $plan->id]) }}" class="button">Start Research</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>

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
                                {{ __('common.money symbol') }}{{ $facility->upgradeCost['money'] }} / {{ $loadCharacter->money }}

                                @if ($facility->upgradeCost['money'] > $loadCharacter->money)
                                    <i class="fas fa-times-circle text-red-500"></i>
                                @else
                                    <i class="far fa-check-circle text-green-500"></i>
                                    @php $canBuild ++; @endphp
                                @endif

                            </td>
                            <td>{{ $facility->upgradeCost['ore'] }} / {{ $facility->base->ore }}

                                @if ($facility->upgradeCost['ore'] > $facility->base->ore)
                                    <i class="fas fa-times-circle text-red-500"></i>
                                @else
                                    <i class="far fa-check-circle text-green-500"></i>
                                    @php $canBuild ++; @endphp
                                @endif
                            </td>
                            <td>{{ $facility->upgradeCost['gas'] }} / {{ $facility->base->gas }}
                                @if ($facility->upgradeCost['gas'] > $facility->base->gas)
                                    <i class="fas fa-times-circle text-red-500"></i>
                                @else
                                    <i class="far fa-check-circle text-green-500"></i>
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

        <div class="w-5/12 md:w-6/12 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('visit-planet') }}" class="button-dark">Cancel</a>
            </div>
        </div>
    </div>
@endsection
