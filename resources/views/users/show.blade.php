@extends('layouts.default')
@section('title', $user->name)

@section('content')
    <div class="users-show row">
        <div class="col-md-3">
            <section class="user-basic-info">
                @include('users._basicinfo', ['user'=>$user])
            </section>
        </div>
        <div class="col-md-9 main-col left-col">
            <div class="panel panel-default">
                <div class="panel-heading">
                    最近话题
                </div>
                <div class="panel-body">
                    @if(! $topics->isEmpty())
                        @include('users.partials.feed')
                        @if(count($topics) > 15)
                            <div class="panel-footer text-right remove-padding-horizontal pager-footer">
                                {{ $topics->links() }}
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