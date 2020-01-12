@extends('site.layout')

@section('body')

    <div class="w-full">
        <div class="card w-full m-auto">
            <div class="card-header">
                <h1>Master Galaxy Map</h1>
            </div>
            <div class="card-body">
                <table class="p-0 m-auto">
                    <tr>
                        <td>&nbsp;</td>
                        @for ($i = config('game.map_size') * -1; $i <= config('game.map_size'); $i++)
                            <td class="text-xs" style="width: 20px; height: 20px">
                                @if (($i % 5) == 0)
                                    {{ $i }}
                                @endif
                            </td>
                        @endfor
                    </tr>
                    @for ($x = config('game.map_size') * -1; $x <= config('game.map_size'); $x++)
                        <tr>
                            <td class="text-xs">
                                @if (($x % 5) == 0)
                                    {{ $x }}
                                @endif
                            </td>
                            @for ($y = config('game.map_size') * -1; $y <= config('game.map_size'); $y++)
                                @if (isset($grid[$x][$y]['id']))
                                    @if ($grid[$x][$y]['id'] > 0)
                                        <td class="border-2 border-gray-700 bg-blue-600 p-0 m-0 text-center">
                                            <a href="{{ route('acp-system', $grid[$x][$y]['id']) }}" class="text-blue-600" title="System: {{ $grid[$x][$y]['name'] }}">
                                                <div style="width: 100%; height: 100%;">*</div>
                                            </a>
                                        </td>
                                    @else
                                    <td class="border-2 border-gray-700 bg-gray-600 p-0 m-0 text-center">
                                        <a href="#" class="text-gray-600 hover:text-gray-600" title="Null Space">
                                            <div style="width: 100%; height: 100%;">-</div>
                                        </a>
                                    </td>

                                    @endif
                                @else
                                    <td class="border-2 border-gray-700 p-0 m-0">&nbsp;</td>
                                @endif
                            @endfor
                        </tr>
                    @endfor
                </table>
            </div>
        </div>

        <div class="w-4/12 m-auto">
            <div class="w-full text-right my-3">
                <a href="{{ route('acp') }}" class="button-dark">Back to ACP</a>
            </div>
        </div>
    </div>
@endsection
