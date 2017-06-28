<form method="post" action="{{route('register')}}">
    {{csrf_field()}}

    <div class="form-group">
        <label for="name">昵称:</label>
        <input type="text" name="name" class="form-control" value="{{old('name')}}">
    </div>

    <div class="form-group">
        <label for="email">邮箱:</label>
        <input type="text" name="email" class="form-control" value="{{old('email')}}">
    </div>

    <div class="form-group">
        <label for="password">密码:</label>
        <input type="password" name="password" class="form-control" value="{{old('password')}}">
    </div>

    <div class="form-group">
        <label for="password_confirmation">确认密码:</label>
        <input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation')}}">
    </div>

    <div class="form-group">
        <label class="tt-label">验证码:</label>
        <input class="tt-text form-control" name="captcha"> <img src="{{captcha_src()}}" alt="验证码" onclick="this.src = '{{captcha_src()}}' + Math.random()">
    </div>

    <button type="submit" class="btn btn-primary">注册</button>
</form>