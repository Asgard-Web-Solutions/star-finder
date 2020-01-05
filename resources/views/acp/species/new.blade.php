@extends('site.layout')

@section('body')
    <div class="card">
        <div class="card-header">
            <h1>Create Species</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('save-species') }}" method="POST">
                @csrf

                <label for="name" class="form-label">Species Name</label>
                <input type="text" class="form-input" name="name" id="name">

                <input type="submit" class="form-button" value="Add Species">
                <a href="{{ route('all-species') }}" class="button-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection