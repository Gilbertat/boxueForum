@extends('layouts.default')

@section('title', '修改密码')

@section('content')
    <div class="user-show">
        <div class="col-md-3 main-col">
            @include('users._setting_nav')
        </div>

        <div class="col-md-9 left-col">
            <div class="panel panel-default padding-md">
                <div class="panel-body">
                    <h2><i class="fa fa-lock" aria-hidden="true"></i>
                        修改密码
                    </h2>
                    <hr>
                    @include('shared.errors')
                    <form class="form-horizontal" method="post" action="{{route('users.update_password', $user->id)}}" accept-charset="UTF-8">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">密码:</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="password" placeholder="请输入新密码">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">确认密码:</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="请再次输入新密码">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <input type="submit" class="btn btn-primary" value="保存">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection