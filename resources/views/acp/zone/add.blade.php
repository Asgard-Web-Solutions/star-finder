@extends('site.layout')

@section('body')
    <div class="card">
        <div class="card-header">
            <h1>New Zone For {{ $starType->name }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('zone-store', $starType->id) }}" method="POST">
                @csrf

                <label for="distance" class="form-label">Distance From Star</label>
                <input type="text" class="form-input" name="distance" id="distance" placeholder="in millions of miles"><br />
                @error('distance')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


                <input type="submit" class="form-button" value="Add Zone To Star Type">
                <a href="{{ route('acp-star-type', $starType->id) }}" class="button-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection