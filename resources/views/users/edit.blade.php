@extends('layouts.app')

@section('content')
    {!! Form::model($user,['route' => ['users.update', $user->id], 'method' => 'put']) !!}
        <div class="form-group">
            {!! Form::label('name', '名前:') !!}
            {!! Form::text('name',null, ['class' => 'form-control']) !!}
            {!! Form::label('email', 'メールアドレス:') !!}
            {!! Form::email('email',null, ['class' => 'form-control']) !!}
            {!! Form::label('age','年齢:') !!}
            {!! Form::text('age', null, ['class' => 'form-control']) !!}
            {!! Form::label('address','住所:') !!}
            {!! Form::text('address', null, ['class' => 'form-control']) !!}
            {!! Form::label('profile', 'プロフィール:') !!}
            {!! Form::textarea('profile', null, ['class' => 'form-control']) !!}
        </div>
    {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection