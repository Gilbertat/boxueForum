@extends('layouts.default')
@section('title')
    {{$topic->title}}
@endsection
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
        <div class="col-md-3 side-bar">
            @include('topics.partials.sidebar')
        </div>
        <div class="col-md-9 topic-show main-col">
            <div class="topic panel panel-default">
                <div class="infos panel-heading">
                    <h1 class="panel-title topic-title">{{$topic->title}}</h1>
                    <a href="javascript:void(0)" id="vote" class="vote_count"
                       data-url="{{ route('topic.vote', $topic->id) }}">
                        <i class="fa fa-star"></i> <i class="vote_value">{{$topic->vote_count}}</i>
                    </a>
                    @include('topics.partials.info')
                </div>
                <div class="content-body entry-content panel-body">
                    @include('topics.partials.body')
                </div>
                @if(Auth::check())
                    @if(Auth::id() == $topic->user_id)
                        @include('topics.partials.operate')
                    @endif
                @endif
            </div>
            @include('topics.partials.replies')
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/inline-attachment.js')}}"></script>
    <script src="{{asset('js/codemirror-4.inline-attachment.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function ()
        {
            var options = {
                uploadUrl: '{{route('topic.attachment')}}',
                uploadFieldName: 'image',
                urlText: "\n ![file]({filename}) \n\n",
                extraParams: {
                    '_token': '{{csrf_token()}}',
                }
            };

            var mdEditor = new SimpleMDE({
                element: $("#editor")[0],
                toolbar: false,
                height: 600,
            });

            inlineAttachment.editors.codemirror4.attach(mdEditor.codemirror, options);

        });
    </script>
@stop