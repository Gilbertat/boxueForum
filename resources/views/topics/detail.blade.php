@extends('layouts.default')
@section('title')
    {{$topic->title}}
@endsection
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
                    <a  href="javascript:void(0)" id="vote" class="vote_count" data-url="{{ route('topic.vote', $topic->id) }}">
                        <i class="fa fa-thumbs-o-up"></i> <i class="vote_value">{{$topic->vote_count}}</i>
                    </a>
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
                placeholder: "请使用Markdown格式书写:-)。",
                width: "100%",
                height: 164,
                watch: false,
                styleActiveLine: false,
                toolbar: false,
                lineNumbers: false,
            });
        });
    </script>
@stop