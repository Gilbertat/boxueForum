@extends('layouts.default')
@section('title', '发布帖子')
<style>
   #global_search_btn {
       top: 10px !important;
   }
   #global_search_form {
       margin-bottom: 0px !important;
   }
</style>
    @section('content')
        <div class="row">
            <div class="col-md-12">
                @include('shared.errors')
                <form action="{{route('topic.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="请填写标题" required>
                    </div>
                    <div class="form-group">
                        <select name="category_id" id="category_select" class="form-control" required>
                            <option value disabled selected>请选择分类</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div id="mdEditor">
                            <textarea style="display: none;" name="mark"></textarea>
                            <textarea class="editormd-html-textarea" name="content_html" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">发布话题</button>
                </form>
            </div>
        </div>
    @stop
@section('script')
    <script src="{{asset('js/inline-attachment.js')}}"></script>
    <script src="{{asset('js/jquery.inline-attachment.js')}}"></script>
    <script type="text/javascript">
        var options = {
            uploadUrl: '{{route('topic.attachment')}}',
            uploadFieldName: 'image',
            urlText: "\n ![file]({filename}) \n\n",
            extraParams: {
                '_token': '{{csrf_token()}}',
            }
        };

        $('.editormd-html-textarea').inlineattachment(options);

        var editor;
        $(function() {
            editor = editormd("mdEditor", {
                toolbarIcons : function() {
                    return ["undo", "redo", "|", "bold", "hr", "del", "italic", "quote", "|","h1", "h2", "h3", "h4","h5", "h6","|", "preview", "fullscreen", "|", "help"]
                },
                placeholder: "请使用Markdown格式书写:-)。",
            });
        });
    </script>
@stop
