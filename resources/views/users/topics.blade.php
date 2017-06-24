@extends('layouts.default')

@section('title')
    {{$user->name}}-话题列表
@endsection

@section('content')
    <div class="users-show row">
        <div class="col-md-3">
            @include('users._basicinfo')
        </div>
        <div class="main-col col-md-9 left-col">
            <ol class="breadcrumb">
                <li><a href="{{route('users.show', [$user->id])}}" data-pjax>个人中心</a></li>
                <li class="active">{{$user->name}}发布的话题({{$user->topic_count}})</li>
            </ol>

            <div class="panel panel-default">
                <div class="panel-body">
                    @if(count($topics))
                        @include('users.partials.feed')
                        @if(count($topics) > 15)
                            <div class="panel-footer text-right remove-padding-horizontal pager-footer">
                                {{$topics->links()}}
                            </div>
                        @endif
                    @else
                        <div class="empty-block">该用户最近没有发帖哦~</div>
                    @endif
                </div>
            </div>

        </div>

    </div>
@endsection
