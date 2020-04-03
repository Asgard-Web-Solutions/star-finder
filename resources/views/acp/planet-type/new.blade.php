@extends('site.layout')

@section('body')
    <div class="card w-1/3">
        <div class="card-header">
            <h1>Create planet Type</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('store-planet-type') }}" method="POST">
                @csrf

                <div>
                    <label for="type" class="form-label">planet Type</label>
                    <input type="text" class="form-input" name="type" id="type">
                </div>
                @error('type')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div>
                    <label for="diameter" class="form-label">planet diameter</label><br>
                    <input type="text" class="form-input" name="diameter" id="diameter" placeholder="in km">
                </div>
                @error('diameter')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div>
                    <label for="planet_gas_multiplier" class="form-label">planet gas multiplier</label><br>
                    <input type="text" class="form-input" name="planet_gas_multiplier" id="planet_gas_multiplier">
                </div>
                @error('planet_gas_multiplier')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div>
                    <label for="planet_gas_type" class="form-label">planet gas type</label><br>
                    <input type="text" class="form-input" name="planet_gas_type" id="planet_gas_type">
                </div>
                @error('planet_gas_type')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div>
                    <label for="planet_ore_multiplier" class="form-label">planet ore multiplier</label><br>
                    <input type="text" class="form-input" name="planet_ore_multiplier" id="planet_ore_multiplier">
                </div>
                @error('planet_ore_multiplier')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div>
                    <label for="planet_ore_type" class="form-label">planet ore type</label><br>
                    <input type="text" class="form-input" name="planet_ore_type" id="planet_ore_type">
                </div>
                @error('planet_ore_type')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div>
                    <label for="diameter_variance" class="form-label">diameter variance</label><br>
                    <input type="text" class="form-input" name="diameter_variance" id="diameter _variance" placeholder="in % change">
                </div>
                @error('diameter_variance')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror



                <input type="submit" class="form-button" value="Add planet">
                <a href="{{ route('all-planet-types') }}" class="button-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection


































