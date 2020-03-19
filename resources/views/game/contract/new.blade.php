@extends('site.layout')

@section('body')

    <div class="w-full">

        @isset($contract)
            <div class="card w-7/12 m-auto">
                <div class="card-header">
                    <h1>Contract Details</h1>
                </div>
                <div class="card-body">
                    Sell <strong class="text-orange-600">{{ $percent[$contract->amount] }}%</strong> of your available <strong class="text-orange-600">{{ __('common.' . $contract->resource) }}</strong> every <strong class="text-orange-600">{{ $time[$contract->frequency] }}</strong> minutes? This contract will cost a one time setup fee of <strong class="text-orange-600">{{ __('common.money symbol') }}{{ ($contract->frequency + $contract->amount) * config('game.contract_base_rate') }}</strong>.

                    <br /><br />
                    <h2 class="text-orange-500">Estimated Income</h2>
                    <p> 
                        When storage is full you will gain approximately <strong class="text-orange-600">{{ __('common.money symbol') }}{{ floor(($storage * ($percent[$contract->amount]) / 100) * $price[$contract->resource]) }} / per hour</strong>.
                    </p>
                    <br />
                    <div class="w-full text-right">
                        <form action="{{ route('confirm-contract', $facility->id) }}" method="post">
                            @csrf

                            <input type="hidden" name="amount" value="{{ $contract->amount }}">
                            <input type="hidden" name="frequency" value="{{ $contract->frequency }}">
                            <input type="hidden" name="resource" value="{{ $contract->resource }}">
                            <input type="submit" value="Sign Contract" class="form-button">
                        </form>
                    </div>
                </div>
            </div>
            <br />
            <br />
        @endisset

        <div class="card w-7/12 m-auto">
            <div class="card-header">
                <h1>Resource Trade Contract</h1>
            </div>
            <div class="card-body">
                <br />
                <p class="m-2">
                    You are about to create a contract to sell <strong>a certain percentage of your stockpile</strong> every few minutes.
                </p>
                
                <p class="m-2">
                    The cost of this will be {{ __('common.money symbol') }}{{ config('game.contract_base_rate') }} x total level of selected options. This cost is a one time fee to establish the contract.
                </p>
                <br />

                <form action="{{ route('submit-contract', $facility->id) }}" method="post">
                    @csrf
                    @php $maxLevel = ($facility->level < 18) ? $facility->level : 18; @endphp

                    <table class="w-full border-white border-2">
                        <tr class="border-white border-2">
                            <td class="border-white border-2"><label for="resource" class="form-label">Resource</label></td>
                            <td class="border-white border-2"><label for="amount" class="form-label">Amount</label></td>
                            <td class="border-white border-2"><label for="frequency" class="form-label">Frequency</label></td>
                        </tr>
                        <tr class="border-2">
                            <td class="border-2">
                                <select name="resource" class="form-input">
                                    <option value="null" disabled selected>Select Resource</option>
                                    <option value="ore">{{ __('common.ore') }} @ {{ __('common.money symbol') }}{{ $price['ore'] }}/each</option>
                                    <option value="gas">{{ __('common.gas') }} @ {{ __('common.money symbol') }}{{ $price['gas'] }}/each</option>
                                </select>
                            </td>
                            <td class="border-2">
                                <select name="amount" class="form-input">
                                    <option value="null" disabled selected>Select Amount</option>
                                    @for ($i = 1; $i <= $maxLevel; $i++)
                                        <option value="{{ $i }}">LVL {{ $i }} = {{ $percent[$i] }}%</option>
                                    @endfor
                                </select>
                            </td>
                            <td class="border-2">
                                <select name="frequency" class="form-input">
                                    <option value="null" disabled selected>Select Frequency</option>
                                    @for ($i = 1; $i <= $maxLevel; $i++)
                                        <option value="{{ $i }}">LVL {{ $i }} = {{ $time[$i] }}m</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                    </table>

                    @error('amount')
                        <span class="text-red-500 pl-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('resource')
                        <span class="text-red-500 pl-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('frequency')
                        <span class="text-red-500 pl-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <br />
                    <div class="w-full text-right">
                        <input type="submit" class="purchase-button" value="Submit Contract for Review">
                    </div>
                </form>

            </div>
        </div>

        <div class="w-7/12 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('visit-planet') }}" class="button-dark">Cancel</a>
            </div>
        </div>
    </div>
@endsection
