@extends('layouts.default')

@section('title', '编辑资料')

    @section('content')
        <div class="user-show">
            <div class="col-md-3 main-col">
                @include('users._setting_nav')
            </div>

            <div class="col-md-9 left-col">
                <div class="panel panel-default padding-md">
                    <div class="panel-body">
                        <h2><i class="fa fa-cog" aria-hidden="true"></i>
                            编辑资料
                        </h2>
                        <hr>
                        @include('shared.errors')
                        <form class="form-horizontal" method="post" action="{{route('users.update', $user->id)}}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{method_field('PATCH')}}
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">昵称</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="nickname" value="{{$user->name}}" placeholder="请输入您的昵称">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">邮箱</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="email" value="{{$user->email}}" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">城市</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="city" value="{{$user->city}}" placeholder="请输入您所在的城市">
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