@extends('layouts.app')

@section('content')

<div class="row">
    <aside class="col-sm-4">
        @include('users.card', ['user' => \App\User::find(Auth::id())])
    </aside>
    <div class="col-sm-8">
        <div class="text-center">
            <h2>退会画面</h2>
            <hr>
            <p>退会すると、アカウントが削除され、復元することができません。</p>
            <p>本当に退会しますか？</p>
        </div>
            <div class="d-flex flex-row-reverse">
                <div>
                    <div class="btn btn-primary btn-lg">
                        <a href="{{ route('users.show', ['user' => Auth::id()]) }}"}} class="text-light">
                            戻る
                        </a>
                    </div>
                </div>
                <div>
                    {!! Form::open(['route' => ['users.destroy', Auth::id()], 'method' => 'delete']) !!}
                        {!! Form::submit('退会', ['class' => "btn btn-danger btn-lg"]) !!}
                    {!! Form::close() !!}
                </div>
            </div>

    </div>
</div>

@endsection