@extends('layouts.app')

@section('content')

    <div id="terms">
        <div id="users-border" class="container py-4">
            <div class="d-flex justify-content-between">
                <h1 class="px-2">Create Term</h1>
            </div>
            <hr>
            <div  class="container">

                {!! Form::open(['route'=>['terms.update', $term], 'method'=>'PUT'])!!}

                <div class="form-group">
                    {!! Form::text('name', $term->name, ['class'=>'form-control', 'placeholder'=>'Title'])!!}
                </div>

                <div class="form-group">
                    {!! Form::textarea('content', $term->content, ['class'=>'form-control' , 'placeholder'=>'Content'])!!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update', ['class'=>'btn btn-primary form-control']) !!}
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
