@extends('layouts.app')

@section('content')
@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
            <li class="media">
                <img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 80) }}" alt="">
                <div class="media-body">
                    <div class="d-flex">
                        <div>
                            <div>
                                {{ $user->name }}
                            </div>
                            <div>
                                <p>{!! link_to_route('users.show', 'View profile', ['user' => $user->id]) !!}</p>
                            </div>
                        </div>
                        <div>
                            @if ($user->role == 1)
                                <p class="text-success">システム管理者</p>
                            @elseif ($user->role == 5)
                                <p class="text-success">管理者</p>
                            @else
                                <p class="text-success">ユーザ</p>
                            @endif
                        </div>
                    </div>
                    <div>
                        @can('admin-higher')
                            <div class="d-flex">
                            {!! Form::open(['route' => ['admin.destroy', $user->id], 'method' => 'delete']) !!}
                                {!! Form::submit('退会させる', ['class' => "btn btn-danger btn-sm"]) !!}
                            {!! Form::close() !!}
                            @include('admin.freeze_button',['user' => $user])
                            </div>
                        @endcan
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{ $users->links('pagination::bootstrap-4') }}
@endif
@endsection