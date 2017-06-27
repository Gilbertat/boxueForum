@extends('layouts.default')
@section('title', '用户列表')
    @section('content')
        <div class="users-show row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="title">用户列表</h2>
                </div>
                <div class="panel-body">
                    @foreach($users as $user)
                        <div class="col-md-3">
                            <section class="user_info">
                                @include('users._basicinfo', ['user'=>$user])
                            </section>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    @endsection