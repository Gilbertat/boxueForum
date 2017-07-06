<div class="meta inline-block">
    <a href="{{route('categories.show', $topic->category_id)}}" class="remove-padding-left" data-pjax>
        <i class="fa fa-folder text-md" aria-hidden="true"></i>{{$topic->category->title}}
    </a>
    .
    <a href="{{route('users.show',  $topic->user->id)}}" class="author" data-pjax>
        {{$topic->user->name}}
    </a>
    .
    <abbr title="{{$topic->created_at}}" class="timeago">{{$topic->created_at->diffForHumans()}}</abbr>
    @if(count($topic->lastReplyUser))

        最后回复由
        <a href="{{URL::route('users.show', [$topic->lastReplyUser->id])}}" data-pjax>
            {{$topic->lastReplyUser->name}}
        </a>
        于<abbr title="{{$topic->updated_at}}" class="timeago">{{$topic->updated_at->diffForHumans()}}</abbr>
        .
    @endif
    {{$topic->view_count}}阅读
</div>