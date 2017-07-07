@extends('layouts.default')
@section('title','全部帖子')
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                @if( ! $topics->isEmpty())
                    <div class="panel-body remove-padding-horizontal">
                        @include('topics._topic_list')
                    </div>
                    @if(count($topics) >= 30)
                        <div class="panel-footer text-right remove-padding-horizontal pager-footer">
                           {{$topics->links()}}
                        </div>
                    @endif
                @else
                    <div class="panel-body">
                        <div class="empty">还没有任何人发帖哦~~</div>
                    </div>
                @endif
            </div>
        </div>
        @include('layouts.partials.sidebar')
    </div>
@endsection
