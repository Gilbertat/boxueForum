@extends('layouts.default')
@section('title', '用户列表')
    @section('content')
        <div class="users-show row">
            <h1>所有用户</h1>
            @foreach($users as $user)
                <div class="col-md-3">
                    <section class="user_info">
                        @include('users._basicinfo', ['user'=>$user])
                    </section>
                </div>
            @endforeach
        </div>
    @endsection