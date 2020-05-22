@if (!$user->freeze)
    {!! Form::open(['route' => ['admin.freeze', $user->id]]) !!}
        {!! Form::submit('凍結する',['class' => 'btn btn-danger btn-sm']) !!}
    {!! Form::close() !!}
@else
{!! Form::open(['route' => ['admin.unzip', $user->id]]) !!}
{!! Form::submit('凍結解除',['class' => 'btn btn-primary btn-sm']) !!}
{!! Form::close() !!}

@endif