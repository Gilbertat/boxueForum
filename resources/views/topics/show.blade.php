@extends('layouts.default')

@section('title', '编辑话题')

    @section('content')
        <div class="row">
            <div class="col-md-9">

            </div>
            <div class="col-md-3">

            </div>
        </div>
    @stop

@section('script')
    <script>
        var editor;
        $(function() {
            editor = editormd("mdEditor", {
                toolbarIcons : function() {
                    return ["undo", "redo", "|", "bold", "hr", "del", "italic", "quote", "|","h1", "h2", "h3", "h4","h5", "h6","|", "preview", "fullscreen", "|", "help"]
                },
                placeholder: "请使用Markdown格式书写:-)。"

            });
        });

        var repeatEditor;
        $(function() {
            repeatEditor = editormd("repeatEditor", {

                placeholder: "请使用Markdown格式书写:-)。"
            });
            repeatEditor.hideToolbar();
        });
    </script>
@stop