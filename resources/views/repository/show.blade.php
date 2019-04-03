@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
            <tr><td>name</td><td>{{ $repository->name }}</td></tr>
            <tr><td>alias</td><td>{{ $repository->alias }}</td></tr>
            <tr><td>token</td><td>{{ $repository->token }}</td></tr>
            </table> 
            <a href="{{ route('repository.edit', $repository->id) }}">edit</a>
            <form action="{{ action('User\RepositoryController@destroy', $repository->id) }}" id="form_{{ $repository->id }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <a href="#" data-id="{{ $repository->id }}" onclick="deletePost(this)">delete</a>
        </div>
    </div>
</div>

<script>

function deletePost(e){
    'use strict';
    if(confirm("delete?")){
        document.getElementById('form_' + e.dataset.id).submit();
    }
}
</script>
@endsection