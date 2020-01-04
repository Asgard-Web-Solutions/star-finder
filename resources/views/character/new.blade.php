@extends('site.layout')

@section('body')
    <form action={{ route("save-character")}} method="POST">
        @csrf
        name:<input type="text" name="name">
        <input type="submit" value="crate character">
    </form>
@endsection
