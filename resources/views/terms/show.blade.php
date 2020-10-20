@extends('layouts.app')

@section('content')

    <h1>Terms of Service</h1>
    @foreach($terms as $term)
        <h3>{{$term->name}}</h3>
        <small><p class="font-italic text-secondary pl-1">{{$term->published_at}}</p></small>
        <p class="lead pl-3">{{$term->content}}</p>
    @endforeach

@endsection
