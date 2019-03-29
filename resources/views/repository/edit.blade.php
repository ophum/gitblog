@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <form action="{{ route('repository.update', $repository->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
                <p><input type="text" id="name" name="name" placeholder="repository url" value="{{ $repository->name }}"></p>
                <p><input type="text" id="alias" name="alias" placeholder="alias" value="{{ $repository->alias}}"></p>
                <p>
                    <input type="text" value="{{ $repository->token }}" readonly>
                    <label for="token">renew token? </label>
                    <input type="checkbox" id="token" name="token" value="checked">
                </p>
                <p><input type="submit" value="submit"></p>
            </form> 
        </div>
    </div>
</div>
@endsection