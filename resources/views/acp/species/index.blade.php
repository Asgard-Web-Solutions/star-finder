@extends('site.layout')

@section('body')

    <div class="w-full">
        <div class="card w-1/3 m-auto">
            <div class="card-header">
                <h1>Species List</h1>
            </div>
            <div class="card-body">
                <table class="p-2 w-full text-center">
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

                <div class="w-full text-right m-2">
                    <a href="{{ route('new-species') }}" class="button">Add Species</a>
                </div>
            </div>
        </div>

        <div class="w-4/12 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('acp') }}" class="button-dark">Back to ACP</a>
            </div>
        </div>
    </div>
@endsection
