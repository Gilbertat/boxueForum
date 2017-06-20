<form method="post" action="{{route('login')}}">
    {{csrf_field()}}
    <div class="form-group">
        <label for="email">邮箱:</label>
        <input type="text" name="email" class="form-control" value="{{old('email')}}">
    </div>

    <div class="form-group">
        <label for="password">密码:</label>
        <input type="password" name="password" class="form-control" value="{{old('password')}}">
    </div>

    <div class="checkbox">
        <label><input type="checkbox" name="remember">七日内自动登录</label>
    </div>

    <button type="submit" class="btn btn-primary">登录</button>
</form>

<hr>
<h4>无法登录?</h4>
<p><a href="{{route('password.request')}}">点击这里</a>重置密码</p>