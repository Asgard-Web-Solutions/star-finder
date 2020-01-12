@extends('site.layout')

@section('body')
    <div class="card w-2/3">
        <div class="card-header">
            <h1>Update System: {{ $system->name }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('update-system', $system->id) }}" method="POST">
                @csrf

                <div>
                    <label for="name" class="form-label">system Name</label>
                    <input type="text" class="form-input" name="name" id="name" value="{{ $system->name }}">
                </div>

                <div>
                    <label for="name" class="form-label">system Description</label>
                    <textarea class="form-input" name="description" id="description">{{ $system->description }}</textarea>
                </div>

                <input type="submit" class="form-button" value="Update system">
                <a href="{{ route('all-systems') }}" class="button-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection
