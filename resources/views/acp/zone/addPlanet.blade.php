@extends('site.layout')

@section('body')
    <div class="card w-1/4">
        <div class="card-header">
            <h1>Add Planet Type</h1>
        </div>
        <div class="card-body">
            <h2 class="text-center text-orange-300 text-xl">{{ $zone->star_type->name }} Zone {{ $zone->order }}</h2>
            <form action="{{ route('zone-planet-store', $zone->id) }}" method="POST">
                @csrf

                <label for="planet" class="form-label">Planet Type</label>
                <select name="planet" id="planet" class="form-input">
                    @foreach ($planets as $planet)
                        <option value="{{ $planet->id }}">{{ $planet->type }}</option>
                    @endforeach
                </select>
                @error('planet')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


                <label for="probability" class="form-label">Probability</label>
                <input type="text" class="form-input" name="probability" id="probability"><br />
                @error('probability')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="w-full my-4">
                    <input type="submit" class="form-button" value="Add Planet Type to Star Type">
                    <a href="{{ route('zone-show', $zone->id) }}" class="button-dark">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection