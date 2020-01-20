@extends('site.layout')

@section('body')

    <div class="w-full">
        <div class="card w-11/12 m-auto">
            <div class="card-header">
                <h1>Action List</h1>
            </div>
            <div class="card-body">
                <table class="p-2 w-full text-center">
                    <thead>
                        <th>Character</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Controller</th>
                        <th>Finishes In</th>
                    </thead>
                    @foreach ($actions as $action)
                        <tr>
                            <td><a href="{{ route('character', $action->character->id) }}">{{ $action->character->name }}</a></td>
                            <td>{{ $action->title }}</td>
                            <td>{{ $action->type }}</td>
                            <td>{{ $action->controller }}</td>
                            <td>{{ $action->finishes_at }}</td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>

        <div class="w-11/12 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('acp') }}" class="button-dark">Back to ACP</a>
            </div>
        </div>
    </div>
@endsection
