@extends('site.layout')

@section('body')
    <div class="card w-3/12">
        <div class="card-header">
            <h1>{{ $zone->star_type->name }} Zone {{ $zone->order }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('zone-update', $zone->id) }}" method="POST">
                @csrf

                <label for="distance" class="form-label">Distance From Star</label>
                <input type="text" class="form-input" name="distance" id="distance" placeholder="in millions of miles" value="{{ $zone->distance }}"><br />
                @error('distance')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input type="submit" class="form-button" value="Update Zone Information">
                <a href="{{ route('acp-star-type', $zone->star_type->id) }}" class="button-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection