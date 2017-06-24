<ul class="list-group row">
    @foreach($replies as $index => $reply)
        @if($index + 1 == count($replies))
            <a href="#last-reply" class="anchor" name="last-reply" aria-hidden="true"></a>
        @endif
        <li class="list-group-item media" style="margin-top: 0px;">
            <div class="avatar avatar-container pull-left">
                <a href="{{route('users.show', [$reply->user_id])}}" data-pjax>
                    <img class="media-object img-thumbnail avatar avatar-middle" src="{{$reply->user->present()->gravatar}}" alt="{{$reply->user->name}}" style="width: 55px; height: 55px;">
                </a>
            </div>

            <div class="infos">
                <div class="media-heading">
                    <a href="{{route('users.show', [$reply->user_id])}}" title="{{$reply->user->name}}" class="remove-padding-left author" data-pjax>
                        {{$reply->user->name}}
                    </a>
                    {{--<span class="operate pull-right">--}}
                        {{--<a class="fa fa-reply" href="javascript:void(0)" onclick="replyOne('{{$reply->user->name}}');" title="回复{{$reply->user->name}}"></a>--}}
                    {{--</span>--}}

                    <div class="meta">
                        <abbr title="{{$reply->created_at}}" class="imeago">{{$reply->created_at->diffForHumans()}}</abbr>
                    </div>
                </div>
                <div class="media-body markdown-body content-body">
                    {!! $reply->content_html !!}
                </div>
            </div>
        </li>
    @endforeach
</ul>