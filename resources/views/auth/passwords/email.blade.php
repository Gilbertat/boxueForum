@extends('layouts.default')
@section('title', '重置密码')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2 floating-box">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">重置密码</h3>
                </div>
                <div class="panel-body">
                    @include('shared.errors')
                    <form action="{{route('password.email')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">邮箱:</label>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" value required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">将重置密码邮件发送给我</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection