<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>注册确认链接</title>
</head>
<body>
    <h1>欢迎注册泊学论坛!</h1>
    <p>
        请点击下面链接完成注册:
        <a href="{{route('confirm_email', $user->activation_token)}}"></a>
        {{route('confirm_email', $user->activation_token)}}
    </p>
    <p>
        如果不是您本人的操作，请忽略此邮件
    </p>
</body>
</html>