@if(count($topics))
    <ul class="list-group row topic-list">
        @foreach($topics as $topic)
            <li class="list-group-item">
                <a class="reply_count_area pull-right" href="#">
                    <div class="count_set">
                        <span class="count_of_replies" title="回复">
                            {{$topic->reply_count}}
                        </span>
                        <span class="count_separator">/</span>
                        <span class="count_of_visits" title="查看">
                            {{$topic->view_count}}
                        </span>
                        <span class="count_separator">|</span>
                        <span class="count_of_likes" title="赞">
                            {{$topic->vote_count}}
                        </span>
                    </div>
                </a>

                <div class="avatar pull-left">
                    <a href="{{route('users.show', [$topic->user_id])}}" title="{{$topic->user->name}}">
                        <img class="media-object img-thumbnail avatar avatar-middle"
                             src="{{$topic->user->present()->gravatar}}" alt="{{$topic->user->name}}">
                    </a>
                </div>
                <div class="infos">
                    <div class="media-heading">
                        <a href="{{$topic->slug}}" title="{{$topic->title}}">
                            {{$topic->title}}
                        </a>
                    </div>
                    <div class="meta">
                        <a href="{{route('categories.show', $topic->category_id)}}" class="category" data-pjax style="color: {{$topic->category->color}}">
                            {{$topic->category->title}}
                        </a>
                        .
                        <abbr title="{{$topic->created_at}}" class="timeago">{{$topic->created_at->diffForHumans()}}</abbr>
                        由
                        <a href="{{route('users.show',  $topic->user->id)}}" class="author" data-pjax style="color: #84dfec;">
                            {{$topic->user->name}}
                        </a>
                        编辑
                        @if(count($topic->lastReplyUser))
                            最后回复由
                            <a href="{{URL::route('users.show', [$topic->lastReplyUser->id])}}" data-pjax style="color: #ec5e2e;">
                                {{$topic->lastReplyUser->name}}
                            </a>
                            于<abbr title="{{$topic->updated_at}}" class="timeago">{{$topic->updated_at->diffForHumans()}}</abbr>
                            .
                        @endif
                        {{$topic->view_count}}阅读
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <div class="empty">还没有任何人发帖哦~~</div>
@endif
