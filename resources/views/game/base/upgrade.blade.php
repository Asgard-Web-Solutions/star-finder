@extends('site.layout')

@section('body')

    <div class="w-full">

        <div class="card w-full md:w-10/12 lg:w-7/12 xl:w-6/12 m-auto">
            <div class="card-header">
                <h1>Base Construction</h1>
            </div>
            <div class="card-body">
                Current Level: {{ $base->level }}<br />
                <br />
                <h2 class="text-orange-400">Funds Available</h2>
                <table class="w-full">
                    <tr>
                        <td>&nbsp;</td>
                        <td>This Base</td>
                        <td>On Planet</td>
                    </tr>
                    <tr>
                        <td>{{ __('common.ore') }}</td>
                        <td>{{ $base->ore }}</td>
                        <td>{{ $planetaryFunds['ore'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('common.gas') }}</td>
                        <td>{{ $base->gas }}</td>
                        <td>{{ $planetaryFunds['gas'] }}</td>
                    </tr>
                </table>
                <br />
                <h2 class="text-orange-400">Cost</h2>
                @php $canBuild = 0; @endphp
                <table class="w-full">
                    <tr>
                        <td>{{ __('common.money') }}</td>
                        <td>{{ __('common.ore') }}</td>
                        <td>{{ __('common.gas') }}</td>
                    </tr>
                    <tr>
                        <td>
                            {{ __('common.money symbol') }}{{ $cost['money'] }}

                            @if ($cost['money'] > $loadCharacter->money)
                                <i class="fas fa-times-circle text-red-500"></i>
                            @else
                                <i class="far fa-check-circle text-green-500"></i>
                                @php $canBuild ++; @endphp
                            @endif

                        </td>
                        <td>{{ $cost['ore'] }}

                            @if ($cost['ore'] > $planetaryFunds['ore'])
                                <i class="fas fa-times-circle text-red-500"></i>
                            @else
                                <i class="far fa-check-circle text-green-500"></i>
                                @php $canBuild ++; @endphp
                            @endif
                        </td>
                        <td>{{ $cost['gas'] }}
                            @if ($cost['gas'] > $planetaryFunds['gas'])
                                <i class="fas fa-times-circle text-red-500"></i>
                            @else
                                <i class="far fa-check-circle text-green-500"></i>
                                @php $canBuild ++; @endphp
                            @endif
                        </td>
                    </tr>
                </table>

                <br />
                @if ($canBuild == 3)
                    <form action="{{ route('upgrade-base', $base->id) }}" method="post">
                        @csrf

                        <input type="hidden" name="confirm" value="true">
                        <input type="submit" class="purchase-button" value="Start Construction">
                    </form>
                @else
                    <div class="w-full text-center">
                        >> Not Enough Resources <<
                    </div>
                @endif
            </div>
        </div>

        <div class="w-full md:w-10/12 lg:w-7/12 xl:w-6/12 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('visit-planet') }}" class="button-dark">Cancel</a>
            </div>
        </div>
    </div>
@endsection
