@extends('layouts.default')
@section('title')
    {{$topic->title}}
@endsection
@include('vendor.editor.head')
<style>
    #AddPlus {
        padding-top: 18px;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-md-3 side-bar">
            @include('topics.partials.sidebar')
        </div>
        <div class="col-md-9 topic-show main-col">
            <div class="topic panel panel-default">
                <div class="infos panel-heading">
                    <h1 class="panel-title topic-title">{{$topic->title}}</h1>
                    @include('topics.partials.info')
                </div>
                <div class="content-body entry-content panel-body">
                    @include('topics.partials.body')
                </div>
            </div>
            @include('topics.partials.replies')
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var editor;
        $(function() {
            editor = editormd("mdEditor", {
                toolbarIcons : function() {
                    return ["undo", "redo", "|", "bold", "hr", "del", "italic", "quote", "|","h1", "h2", "h3", "h4","h5", "h6","|", "preview", "fullscreen", "|", "help"]
                },
                placeholder: "请使用Markdown格式书写:-)。",
                width: "100%",
                height: 164,
                watch: false,
                toolbar: false,
                lineNumbers: false,
            });
        });
    </script>
@stop