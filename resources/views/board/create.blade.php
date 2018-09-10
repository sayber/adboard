@extends('layouts.master')

@section('content')
    <h1>Add new ad</h1>
    <hr/>
    {!! Form::open(['url' => '/board', 'class' => 'form-horizontal', 'role' => 'form','files'=>'true']) !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                <span class="help-block text-danger">
                    {{ $errors -> first('title') }}
                </span>
            </div>
        </div>
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('body', 'Body', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                <span class="help-block text-danger">
                    {{ $errors -> first('body') }}
                </span>
            </div>
        </div>
        <div class="form-group">

            <label for="photo">Select photo</label>
            {!!  Form::file('image') !!}
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-5">
                {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}
@endsection