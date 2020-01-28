@extends('site.layout')

@section('body')

    <div class="w-full">
        <div class="card w-6/12 m-auto">
            <div class="card-header">
                <h1>Base List</h1>
            </div>
            <div class="card-body">
                <table class="p-2 w-full text-center">
                    <thead>
                        <th>ID</th>
                        <th>Character</th>
                        <th>Planet</th>
                        <th>Level</th>
                        <th>Bonus</th>
                        <th>{{ __('common.ore') }}</th>
                        <th>{{ __('common.gas') }}</th>
                        <th>Status</th>
                    </thead>
                    @foreach ($bases as $base)
                        <tr class="bg-gray-600">
                            <td>{{ $base->id }}</td>
                            <td><a href="{{ route('character', $base->character_id) }}">{{ $base->character->name }}</a></td>
                            <td>{{ $base->planet->system->name }} - {{ $base->planet->name }}</td>
                            <td>{{ $base->level }}</td>
                            <td>{{ $base->bonus }}</td>
                            <td>{{ $base->ore }}</td>
                            <td>{{ $base->gas }}</td>
                            <td>{{ $base->status }}</td>
                        </tr>
                        <tr>
                            <td rowspan="{{ $base->facilities->count() }}">&nbsp;</td>
                            <td colspan="7">
                                <table class="w-full">
                                    @foreach ($base->facilities as $facility)
                                        <tr>
                                            <td>Facility {{ $facility->id }}</td>
                                            <td>{{ $facility->facility_type->name }}</td>
                                            <td>{{ $facility->level }}</td>
                                            <td>{{ $facility->bonus }}</td>
                                            <td>
                                                @if ($facility->full)
                                                    <span class="text-red-700"><i class="fas fa-power-off"></i></span>
                                                @else
                                                    <span class="text-green-700"><i class="fas fa-power-off"></i></span>
                                                @endif
                                            </td>
                                            <td>{{ $facility->mined_at }}</td>
                                            <td>{{ $facility->status }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
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
