<div class="replies panel panel-default list-panel replies-index">
    <div class="panel-heading">
        <div class="total">回复:{{$topic->reply_count}}</div>
    </div>
    <div class="panel-body">
        @if(count($replies))
            @include('topics.partials.replies_info')
            <div class="panel-footer text-right remove-padding-horizontal pager-footer">
                {{$replies->links()}}
            </div>
        @else
            <ul class="list-group row"></ul>
            <div class="empty-block text-center">暂无评论~</div>
        @endif
    </div>
</div>
@if(Auth::check())
    <div class="reply-box form box-block">
        @include('shared.errors')
        <form method="post" action="{{route('replies.store')}}" accept-charset="UTF-8">
            {{csrf_field()}}
            <input type="hidden" name="topic_id" value="{{$topic->id}}">
            <div class="form-group">
                <div id="mdEditor">
                    <textarea style="display: none" name="mark"></textarea>
                    <textarea class="editormd-html-textarea" name="content_html" id="reply_content"></textarea>
                </div>
            </div>
            <div class="form-group reply-post-submit">
                <button type="submit" class="btn btn-primary">回复</button>
            </div>
        </form>
    </div>
@endif
