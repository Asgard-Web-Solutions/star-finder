@extends('site.layout')

@section('body')
    <div class="bg-gray-800 rounded-b rounded-t-lg w-1/3 max-w-sm my-auto text-gray-100">
        <div class="bg-gray-300 text-blue-400 shadow-lg rounded-t w-full my-auto text-center">
            <h1 class="text-orange-600 text-2xl">Species List</h1>
        </div>

        <ul>
            @foreach ($species as $aspecies)
                <li> {{ $aspecies->name }}</li>
            @endforeach
        </ul>

        <div class="w-full text-right">
            <a href="{{ route('new-species') }}" class="form-button">Add Species</a>
        </div>
    </div>
@endsection