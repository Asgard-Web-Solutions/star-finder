@extends('site.layout')

@section('body')

    <div class="w-full">
        <div class="card w-1/3 m-auto">
            <div class="card-header">
                <h1>Action List</h1>
            </div>
            <div class="card-body">
                <table class="p-2 w-full text-center">
                    <thead>
                        <th></th>
                        <th></th>
                    </thead>
                    @foreach ($actions as $action)
                        <tr>
                        </tr>
                    @endforeach
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
