@extends('layouts.app')

@section('content')
<div class="row">
    <aside class="col-sm-4">
        @include('users.card', ['user' => App\User::find(Auth::id())])
    </aside>
    <div class="col-sm-8">
            @include('microposts.microposts', ['microposts' => $microposts])
    </div>
@endsection