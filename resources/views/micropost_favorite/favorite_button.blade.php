@if (Auth::user()->is_favoriting($micropost))
    {!! Form::open(['route' => ['user.unfavorite', $micropost], 'method' => 'delete']) !!}
        {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-sm"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['user.favorite', $micropost]]) !!}
        {!! Form::submit('Favorite', ['class' => "btn btn-success btn-sm"]) !!}
    {!! Form::close() !!}
@endif