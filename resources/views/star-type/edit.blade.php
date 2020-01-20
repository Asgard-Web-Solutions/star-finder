@extends('site.layout')

@section('body')
    <div class="card w-2/3">
        <div class="card-header">
            <h1>edit star {{ $star->name }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('update-star-type', $star->id) }}" method="POST">
                @csrf

                <div>
                    <label for="name" class="form-label">star type</label>
                    <input type="text" class="form-input" name="name" id="name" value="{{ $star->type }}">
                </div>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                 @enderror

                <div>
                    <label for="name" class="form-label">star diameter</label>
                    <input type="text" class="form-input" name="diameter" id="diameter" value='{{ $star->diameter }}'>
                </div>
                @error('dimaeter')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                 @enderror
                <div>
                    <label for="color" class="form-label">star color</label>
                    <input type="text" class="form-input" name="color" id="color" value='{{ $star->color }}'>
                </div>
                @error('color')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <input type="submit" class="form-button" value="edit star">
                <a href="{{ route('all-star-types') }}" class="button-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection
