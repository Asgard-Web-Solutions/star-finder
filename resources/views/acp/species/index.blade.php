@extends('site.layout')

@section('body')
    <div class="bg-gray-800 rounded-b rounded-t-lg w-1/3 max-w-sm my-auto text-gray-100">
        <div class="bg-gray-300 text-blue-400 shadow-lg rounded-t w-full my-auto text-center">
            <h1 class="text-orange-600 text-2xl">Species List</h1>
        </div>

        <table class="p-2 w-full">
            <thead>
                <th>Species Name</th>
                <th>Edit Species</th>
            </thead>
            @foreach ($species as $aspecies)
                <tr>
                    <td class="pl-2"><a href="{{ route('species', $aspecies->id) }}">{{ $aspecies->name }}</a></td>
                    <td><a href="{{ route('edit-species', $aspecies->id) }}">Edit</a></td>
                </tr>
            @endforeach
        </table>

        <div class="w-full text-right">
            <a href="{{ route('new-species') }}" class="button">Add Species</a>
        </div>
    </div>
@endsection
