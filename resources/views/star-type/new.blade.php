@extends('site.layout')

@section('body')
    <div class="card w-1/3">
        <div class="card-header">
            <h1>Create Star Type</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('store-star-type') }}" method="POST">
                @csrf

                <div>
                    <label for="name" class="form-label">Star Type Name</label>
                    <input type="text" class="form-input" name="name" id="name">
                </div>
                @error('name')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div>
                    <label for="diameter" class="form-label">Star diameter</label><br>
                    <input type="text" class="form-input" name="diameter" id="diameter" placeholder="in 1000km">
                </div>
                @error('diameter')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div>
                    <label for="color" class="form-label">Star color</label><br>
                    <input type="text" class="form-input" name="color" id="color">
                </div>
                @error('color')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div>
                    <label for="probability" class="form-label">Star probability</label><br>
                    <input type="text" class="form-input" name="probability" id="probability" placeholder="in %">
                </div>
                @error('probability')
                    <span class="text-red-700" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input type="submit" class="form-button" value="Add Star">
                <a href="{{ route('all-star-types') }}" class="button-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection
