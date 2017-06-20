@extends('layouts.default')
@section('title', '修改头像')

@section('content')
    <div class="user-show">
        <div class="col-md-3 main-col">
            @include('users._setting_nav')
        </div>

        <div class="col-md-9 left-col">
            <div class="panel panel-default padding-md">
                <div class="panel-body padding-bg">
                    <h2>
                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                        修改头像
                    </h2>
                    <hr>

                    @include('shared.errors')

                    <form method="post" action="{{route('users.update_avatar', $user->id)}}" enctype="multipart/form-data" accept-charset="UTF-8">
                        {{method_field('PATCH')}}
                        {!! csrf_field() !!}
                        <div id="image-preview-div">
                            <label for="exampleInputFile">请选择图片:</label>
                            <br>
                            <img id="preview-img" src="{{$user->present()->gravatar(380)}}" class="avatar-preview-img" alt="">
                        </div>
                        <div class="form-group">
                            <input class="in-avatar" type="file" name="avatar" id="file" required>
                        </div>
                        <br>
                        <button class="btn btn-lg btn-primary" id="upload-button" type="submit">上传头像</button>
                        <div class="alert alert-info" id="loading" style="display: none" role="alert">
                            上传头像中...
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <div id="message"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop