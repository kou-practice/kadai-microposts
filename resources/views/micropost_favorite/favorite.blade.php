<ul class="media-list">
    @foreach ($favoritings as $favoriting)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src(App\User::find($favoriting->user_id)->email, 50) }}" alt="">
            <div class="media-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div>
                            {!! link_to_route('users.show', App\User::find($favoriting->user_id)->name, ['user' => $favoriting->user->id]) !!} <span class="text-muted">posted at {{ $favoriting->created_at }}</span>
                        </div>
                        <div>
                            <p class="mb-0">{!! nl2br(e($favoriting->content)) !!}</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d-flex">
                            <div>
                                @include('micropost_favorite.favorite_button',['micropost'=>$favoriting->id])
                            </div>
                            <div>
                                @include('microposts.delete_button',['micropost' => $favoriting])
                            </div>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $favoritings->links('pagination::bootstrap-4') }}
