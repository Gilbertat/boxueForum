@extends('layouts.default')
@section('title', '重置密码')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2 floating-box">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">更新密码</h3>
                </div>
                <div class="panel-body">
                    @include('shared.errors')
                    <form action="{{route('password.request')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">邮箱:</label>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" value="{{ $email or old('email') }}" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">密码:</label>
                            <div class="col-md-6">
                                <input type="password" name="password" class="form-control" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm" class="col-md-4 control-label">确认密码:</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">重置密码</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection