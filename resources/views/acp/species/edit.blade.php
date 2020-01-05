@extends('site.layout')

@section('body')
    <div class="card">
        <div class="card-header">
            <h1>Update Species {{ $species->name }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('update-species', $species->id) }}" method="POST">
                @csrf

                <label for="name" class="form-label">Species Name</label>
                <input type="text" class="form-input" name="name" id="name" value="{{ $species->name }}">

                <input type="submit" class="form-button" value="Update Species">
                <a href="{{ route('all-species') }}" class="button-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection