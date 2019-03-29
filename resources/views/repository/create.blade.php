@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('repository.store') }}" method="POST">
            {{ csrf_field() }}
            <p><input type="text" id="name" name="name" placeholder="repository url"></p>
            <p><input type="text" id="alias" name="alias" placeholder="alias"></p>
            <p><input type="submit" value="submit"></p>
            </form>

        </div>
    </div>
</div>
@endsection