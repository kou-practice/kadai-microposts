@if (Auth::id() == $micropost->user_id)
    {{ Form::button('Edit', ['class' => "btn btn-primary btn-sm", 'data-toggle' => 'modal', "data-target" => "#a".$micropost->id])}}

    <div class="modal fade" id="a{{ $micropost->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::model($micropost, ['route' => ['microposts.update',$micropost->id], 'method' => 'put']) !!}
                    <div class="form-group">
                        {!! Form::label('content', 'POST') !!}
                        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                    </div>
                    {!! Form::submit('更新', ['class' =>'btn btn-primary']) !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endif
</div>