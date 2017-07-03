@extends('layouts.default')

@section('title', '编辑话题')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('shared.errors')
            <form action="{{route('topic.update', $topic->id)}}" method="post" style="margin-bottom: 1em;">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="请填写标题" required
                           value="{{$topic->title}}">
                </div>
                <div class="form-group">
                    <select name="category_id" id="category_select" class="form-control" required>
                        <option value="{{$topic->category_id}}" selected>{{$topic->category->title}}</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div id="mdEditor">
                        <textarea style="display: none;" name="mark">{{$topic->content_raw}}</textarea>
                        <textarea class="editormd-html-textarea" name="content_html" required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">保存更改</button>
            </form>
        </div>
    </div>
@stop

@section('script')
    <script>
        var editor;
        $(function () {
            editor = editormd("mdEditor", {
                toolbarIcons: function () {
                    return ["undo", "redo", "|", "bold", "hr", "del", "italic", "quote", "|", "h1", "h2", "h3", "h4", "h5", "h6", "|", "preview", "fullscreen", "|", "help"]
                },
                placeholder: "请使用Markdown格式书写:-)。"

            });
        });
    </script>
@stop