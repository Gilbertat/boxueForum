<div class="replies panel panel-default list-panel replies-index">
    <div class="panel-heading">
        <div class="total">回复:{{$topic->reply_count}}</div>
    </div>
    @if(count($replies))
        <div class="panel-body">
            @include('topics.partials.replies_info')
        </div>
        @if($replies->hasMorePages())
            <div class="panel-footer text-right remove-padding-horizontal pager-footer">
                {{$replies->links()}}
            </div>
        @endif
    @else
        <ul class="list-group row"></ul>
        <div class="empty-block text-center">暂无评论~</div>
    @endif
</div>

@if(Auth::check())
    <div class="reply-box form box-block">
        @include('shared.errors')
        <form method="post" action="{{route('replies.store')}}" accept-charset="UTF-8">
            {{csrf_field()}}
            <input type="hidden" name="topic_id" value="{{$topic->id}}">
            <div class="form-group topic-replies">
                <textarea name="editor" id="editor"></textarea>
            </div>
            <div class="form-group reply-post-submit">
                <button type="submit" class="btn btn-primary">回复</button>
            </div>
        </form>
    </div>
@endif
