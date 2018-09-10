
<div class="row">
    <div class="col-md-6 mb-3">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null,['class' => 'form-control']) !!}
        <span class="help-block text-danger">
            {{ $errors -> first('name') }}
        </span>
    </div>
    <div class="col-md-6 mb-3">
        {!! Form::label('email', 'Email Address') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
        <span class="help-block text-danger">
            {{ $errors -> first('email') }}
        </span>
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        {!! Form::label('firstname', 'First name') !!}
        {!! Form::text('firstname', $user['info']['firstname'] ,['class' => 'form-control']) !!}
        <span class="help-block text-danger">
            {{ $errors -> first('firstname') }}
        </span>
    </div>
    <div class="col-md-4 mb-3">
        {!! Form::label('secondname', 'Second name') !!}
        {!! Form::text('secondname', $user['info']['secondname'],['class' => 'form-control']) !!}
        <span class="help-block text-danger">
            {{ $errors -> first('secondname') }}
        </span>
    </div>
    <div class="col-md-4 mb-3">
        {!! Form::label('lastname', 'Last name') !!}
        {!! Form::text('lastname', $user['info']['lastname'],['class' => 'form-control']) !!}
        <span class="help-block text-danger">
            {{ $errors -> first('lastname') }}
        </span>
    </div>
</div>



<div class="mb-3">
    {!! Form::label('phone', 'Phones') !!}
    {!! Form::text('phone', $user['info']['phone'],['class' => 'form-control']) !!}
    <span class="help-block text-danger">
        {{ $errors -> first('phone') }}
    </span>
</div>