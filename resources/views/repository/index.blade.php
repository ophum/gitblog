@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($repositories as $repository)
            <li><a href="{{ route('repository.show', $repository->id) }}">{{ $repository->name }}</a></li>
            @endforeach

        </div>
    </div>
</div>
@endsection