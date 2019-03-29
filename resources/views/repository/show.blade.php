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

        </div>
    </div>
</div>
@endsection