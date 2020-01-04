@extends('site.layout')

@section('body')
    <div class="bg-gray-800 rounded-b rounded-t-lg w-1/3 max-w-sm my-auto text-gray-100">
        <div class="bg-gray-300 text-blue-400 shadow-lg rounded-t w-full my-auto text-center">
            <h1 class="text-orange-600 text-2xl">Game Elements</h1>
        </div>

        <table>
            <tr>
                <td><a href="{{ route('all-species') }}" class="underline text-orange-500 hover:text-orange-400 hover:no-underline">Species</a></td>
                <td><a href="{{ route('new-species') }}" class="underline text-orange-500 hover:text-orange-400 hover:no-underline">New</a></td>
        </table>

    </div>
@endsection