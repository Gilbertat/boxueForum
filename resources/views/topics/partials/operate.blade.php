<div class="panel-footer">
    <div class="pull-right action">
        <a href="{{route('topic.edit', $topic->id)}}" class="topic_edit" title="编辑该帖">
            <i class="fa fa-edit"></i>
        </a>
        @if($topic->is_hidden == 1)
            <a href="javascript:void(0);" data-method="delete" id="topic_delete_button" 
               data-content="隐藏该帖" class="admin popover-with-html"
               title="隐藏该帖">
                <i class="fa fa-trash-o"></i>
            </a>
            <form id="topic_delete_form" action="{{route('topic.delete', [$topic->id])}}" method="post" style="display: none;">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE">
            </form>
        @else
            <a href="javascript:void(0);" data-method="post" id="topic_retry_button"
               data-content="恢复该帖" class="admin popover-with-html"
               title="恢复该帖">
                <i class="fa fa-refresh"></i>
            </a>
            <form id="topic_retry_form" action="{{route('topic.retry', [$topic->id])}}" method="post" style="display: none;">
                {{csrf_field()}}
            </form>
        @endif
    </div>
</div>