@extends('site.layout')

@section('body')
    <div class="bg-gray-800 rounded-b rounded-t-lg w-1/3 max-w-sm my-auto text-gray-100">
        <div class="bg-gray-300 text-blue-400 shadow-lg rounded-t w-full my-auto text-center">
            <h1 class="text-orange-600 text-2xl">character creation</h1>
        </div>

        <form action="{{ route('save-character') }}" method="POST">
            @csrf

            <label for="name" class="form-label">character Name</label>
            <input type="text" class="form-input" name="name" id="name">

            <select name="species" class="form-input">
                @foreach ($species as $aspecies)
                    <option value="{{$aspecies->id}}">{{$aspecies->name}}</option>
                @endforeach

            </select>
            <input type="submit" class="form-button" value="create character">
        </form>
    </div>
@endsection
