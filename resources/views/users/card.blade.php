<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <div class="card-body">
        <img class="rounded img-fluid" src="{{ Gravatar::src($user->email, 200) }}" alt="">
    </div>
    <div class="card-body">
        @if ($user->age)
        <p>年齢:{{ $user->age }}</p>
        @endif
        @if ($user->address)
        <p>住所:{{ $user->address }}</p>
        @endif
        @if ($user->profile)
        <p>プロフ</p>
        <hr>
        <p> {!! nl2br(e($user->profile)) !!}</p>
        @endif
    </div>
</div>
@include('user_follow.follow_button', ['user' => $user])