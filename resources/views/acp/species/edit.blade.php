@extends('site.layout')

@section('body')
    <div class="card w-2/3">
        <div class="card-header">
            <h1>Update Species {{ $species->name }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('update-species', $species->id) }}" method="POST">
                @csrf

                <div>
                    <label for="name" class="form-label">Species Name</label>
                    <input type="text" class="form-input" name="name" id="name" value="{{ $species->name }}">
                </div>

                <div>
                    <label for="name" class="form-label">Species Description</label>
                    <textarea class="form-input" name="description" id="description">{{ $species->description }}</textarea>
                </div>

                <input type="submit" class="form-button" value="Update Species">
                <a href="{{ route('all-species') }}" class="button-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection
