@if (Auth::id() == $micropost->user_id ||\App\User::find(\Auth::id())->role <= 5)
    {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
    {!! Form::close() !!}
@endif