@extends('layouts.default')

@section('title')
    {{$query}} · 搜索结果
@endsection

@section('content')
    <div class="panel panel-default list-panel search-results">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-search"></i>
                关于 "{{$query}}" 的搜索结果, 共{{count($users) + count($topics)}}条
            </h3>
        </div>
        <div class="panel-body">
            @if(count($users))
                @foreach($users as $user)
                    @include('searches.partials.user')
                @endforeach
            @endif

            @if(count($topics))
                @foreach($topics as $topic)
                    @include('searches.partials.topic')
                @endforeach
            @endif

            @if((count($topics) + count($users)) <= 0)
                <div class="empty-block">没有搜到任何有关于{{$query}}的数据!</div>
            @endif
        </div>

        @if(count($topics) > 30)
            <div class="panel-footer">
                {!! $topics->appends(Request::except('page', '_pjax'))->render() !!}
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            var query = '{{$query}}'
            var result = query.match(/("[^"]+"|[^"\s]+)/g);
            result.forEach(function (entry) {
                $('.search-results').highlight(entry);
            });
        });
    </script>
@endsection