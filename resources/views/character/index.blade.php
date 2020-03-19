@extends('site.layout')

@section('body')

    <div class="w-full">
        <div class="card w-6/12 m-auto">
            <div class="card-header">
                <h1>character List</h1>
            </div>
            <div class="card-body">
                <table class="p-2 w-full text-center">
                    <thead>
                        <th>Character Name</th>
                        <th>Species</th>
                        <th>Location</th>
                        <th>{{ __('common.money') }}</th>
                        <th>Player Name</th>
                    </thead>
                    @foreach ($characters as $character )
                        <tr>
                            <td><a href="{{ route('character', $character->id) }}">{{ $character->name }}</a></td>
                            <td>{{ $character->species->name }}</td>
                            <td>
                                @if ($character->planet_id)
                                    {{ $character->planet->name }}
                                @endif
                            </td>
                            <td>{{ __('common.money symbol') }}{{ $character->money }}</td>
                            <td><a href="{{ route('user', $character->user->id) }}">{{ $character->user->name }}</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="w-6/12 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('acp') }}" class="button-dark">Back to ACP</a>
            </div>
        </div>
    </div>
@endsection
