@extends('layouts.app')

@section('content')

    <div id="terms">
        <div id="users-border" class="container py-4">
            <div class="d-flex justify-content-between">
                <h1 class="px-2">Terms</h1>
                <div class="form-group">
                    <a href="{{ route('terms.create') }}" class="btn btn-success mr-3">Create Term</a>
                </div>
            </div>
            <hr>
            <div  class="container">
                <table class="table table-striped bg-white">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Content</th>
                        <th>Added</th>
                        <th>Published</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$terms->isEmpty())
                        @foreach($terms as $term)
                            <tr>
                                <th scope="row">{{ $term->id }}</th>
                                <td>{{ $term->name }}</td>
                                <td>{{ $term->content }}</td>
                                <td>{{ \Carbon\Carbon::parse($term->created_at)->diffForHumans()}}</td>
                                <td>
                                    <div class="row">
                                        @if($term->published_at)
                                            <p>{{ $term->published_at }}</p>
                                        @else
                                            {!! Form::open(['route'=>['terms.publish', $term] , 'method'=>'POST']) !!}

                                            <div class="form-group">
                                                <a href="{{ route('terms.edit', $term->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                {!! Form::submit('Publish', ['class'=>'btn btn-warning btn-sm']) !!}
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td>No terms</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
