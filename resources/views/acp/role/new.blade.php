@extends('site.layout')

@section('body')
    <div class="card">
        <div class="card-header">
            <h1>Create Role</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('save-role') }}" method="POST">
                @csrf

                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-input" name="name" id="name" ><br />

                <label for="color_class" class="form-label">Color Class</label>
                <input type="text" class="form-input" name="color_class" id="color_class"><br />


                <input type="submit" class="form-button" value="Update role">
                <a href="{{ route('all-roles') }}" class="button-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection