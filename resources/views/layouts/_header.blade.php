<div role="navigation" class="navbar navbar-default topnav ">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a href="{{route('home')}}" class="navbar-brand">泊学论坛</a>

        </div>

        <div id="top-navbar-collapse" class="collapse navbar-collapse">
            <div class="navbar-right">
                <ul class="nav navbar-nav login">
                    @if(Auth::check())
                        <li>
                        </li>
                        <li>
                            <a href="#" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dLabel">
                                <img class="avatar-topnav" src="{{Auth::user()->present()->gravatar}}" alt="avatar">
                                {{Auth::user()->name}}
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li>
                                    <a class="button" href="{{route('users.show', Auth::user()->id)}}">
                                        <i class="fa fa-user text-md"></i>个人中心
                                    </a>
                                </li>
                                <li>
                                    <a class="button" href="{{route('users.edit', Auth::user()->id)}}">
                                        <i class="fa fa-cog text-md"></i>编辑资料
                                    </a>
                                </li>
                                <li>
                                    <a  id="login-out" class="button"  href="javascript:void(0)" data-lang-loginout="你确定要退出吗？" data-url="{{route("logout")}}">
                                        <i class="fa fa-sign-out text-md"></i>退出
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <a href="{{route('signup')}}" class="btn btn-default btn-sm register-btn">
                                注册
                        </a>
                        <a href="{{route('login')}}" class="btn btn-primary btn-sm login-btn">
                                登录
                        </a>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>