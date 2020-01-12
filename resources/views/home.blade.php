@extends('site.layout')

@section('body')
    @if (!$loadcharacter)
        <a class="button" href="{{ route ('new-character') }}">create charater</a>
    @endif
@endsection
