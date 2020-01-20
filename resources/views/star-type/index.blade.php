@extends('site.layout')

@section('body')

    <div class="w-full">
        <div class="card w-1/3 m-auto">
            <div class="card-header">
                <h1>stars</h1>
            </div>
            <div class="card-body">
                <table class="p-2 w-full text-center">
                    <thead>
                        <th>star type</th>
                        <th>Edit star</th>
                    </thead>
                    @foreach ($stars as $star)
                        <tr>
                            <td class="pl-2"><a href="{{ route('acp-star-type', $star->id) }}">{{ $star->type }}</a></td>
                            <td><a href="{{ route('edit-star-type', $star->id) }}">Edit</a></td>
                        </tr>
                    @endforeach
                </table>

                <div class="w-full text-right m-2">
                    <a href="{{ route('create-star-type') }}" class="button">Add Star</a>
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
