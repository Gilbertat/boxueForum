@extends('layouts.default')
@section('title')
    {{$user->name}}的关注者
@endsection

@section('content')
    <div class="users-show row">
        <div class="col-md-3">
            @include('users._basicinfo')
        </div>
        <div class="main-col col-md-9 left-col">
            <ol class="breadcrumb">
                <li><a href="{{route('users.show', $user->id)}}">个人中心</a></li>
                <li class="active">{{$user->name}}的关注者</li>
            </ol>

            <div class="panel panel-default">
                <div class="panel-body">
                    @if(count($users))
                        @include('users.partials.users')
                        @if(count($users) > 15)
                            <div class="panel-footer text-right remove-padding-horizontal pager-footer">
                                {{ $users->links() }}
                            </div>
                        @endif
                    @else
                        <div class="empty-block">{{$user->name}}还没有任何关注者哦~~~</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection