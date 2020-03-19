@extends('site.layout')

@section('body')

    <div class="w-full">

        <div class="card w-3/12 m-auto">
            <div class="card-header">
                <h1>Sell {{ __('common.' . $sell['Material']) }}</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('confirm-sell-materials', ['base' => $base->id, 'material' => $sell['Material']]) }}" method="post">
                    @csrf

                    <strong class="pl-2">Max:</strong> {{ $sell['Amount'] }}<br />
                    <strong class="pl-2">Value:</strong> {{ __('common.money symbol') }}{{ $sell['Price'] }}<br />
                    <p class="text-xs pl-2">NOTE that {{ __('common.money') }} are only available in whole amounts.</p>
                    <br />
                    <label for="amount" class="form-label">Amount to Sell</label>
                    <input type="text" class="form-input" name="amount" id="amount" value="{{ $sell['Amount'] }}"><br />

                    @error('amount')
                        <span class="text-red-500 pl-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                    <input type="submit" class="purchase-button" value="Sell {{ __('common.' . $sell['Material']) }}">
                </form>
            </div>
        </div>

        <div class="w-1/4 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('visit-planet') }}" class="button-dark">Cancel</a>
            </div>
        </div>
    </div>
@endsection
