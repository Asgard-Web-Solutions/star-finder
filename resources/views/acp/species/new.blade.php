@extends('site.layout')

@section('body')
    <div class="bg-gray-800 rounded-b rounded-t-lg w-1/3 max-w-sm my-auto text-gray-100">
        <div class="bg-gray-300 text-blue-400 shadow-lg rounded-t w-full my-auto text-center">
            <h1 class="text-orange-600 text-2xl">Create Species</h1>
        </div>

        <form action="{{ route('save-species') }}" method="POST">
            @csrf

            <label for="name" class="form-label">Species Name</label>
            <input type="text" class="form-input" name="name" id="name">

            <input type="submit" class="form-button" value="Add Species">
        </form>
    </div>
@endsection