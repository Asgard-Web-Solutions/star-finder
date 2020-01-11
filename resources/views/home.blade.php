@extends('site.layout')

@section('body')
    @if (!$character)
        <a class="button" href="{{ route ('new-character') }}">create charater</a>
    @endif
@endsection
