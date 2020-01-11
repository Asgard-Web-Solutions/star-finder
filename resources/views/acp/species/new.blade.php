@extends('site.layout')

@section('body')
    <div class="card w-2/3">
        <div class="card-header">
            <h1>Create Species</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('save-species') }}" method="POST">
                @csrf

                <div>
                    <label for="name" class="form-label">Species Name</label>
                    <input type="text" class="form-input" name="name" id="name">
                </div>

                <div>
                    <label for="name" class="form-label">Species Description</label>
                    <textarea class="form-input" name="description" id="description"></textarea>
                </div>

                <input type="submit" class="form-button" value="Add Species">
                <a href="{{ route('all-species') }}" class="button-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection
