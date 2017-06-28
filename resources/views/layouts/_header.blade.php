<div role="navigation" class="navbar navbar-default topnav ">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a href="{{route('home')}}" class="navbar-brand" data-pjax>泊学论坛</a>

        </div>

        <div id="top-navbar-collapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class>

                </li>
            </ul>
            <div class="navbar-right">
                <div class="aw-search-box hidden-xs hidden-sm">
                    <form class="navbar-search" action="{{route('search')}}" id="global_search_form" method="get">
                        <input class="form-control search-query" type="text" placeholder="搜索问题或人" name="q" id="aw-search-query">
                        <span title="搜索" id="global_search_btn" onclick="$('#global_search_form').submit();">
                            <i class="fa fa-search"></i>
                        </span>
                        {{--<div class="aw-dropdown" style="display: none;">--}}
                            {{--<div class="mod-body">--}}
                                {{--<p class="title">输入关键字进行搜索</p>--}}
                                {{--<ul class="aw-dropdown-list hide"></ul>--}}
                                {{--<p class="search">--}}
                                    {{--<span>搜索:</span>--}}
                                    {{--<a onclick="$('#global_search_form').submit();"></a>--}}
                                {{--</p>--}}
                            {{--</div>--}}
                            {{--<div class="mod-footer">--}}
                                {{--<a href="{{route('topic.create')}}" class="pull-right btn btn-mini btn-success publish">发起问题</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </form>
                </div>

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
                                    <a class="button" href="{{route('users.show', Auth::user()->id)}}" data-pjax>
                                        <i class="fa fa-user text-md"></i>个人中心
                                    </a>
                                </li>
                                <li>
                                    <a class="button" href="{{route('users.edit', Auth::user()->id)}}" data-pjax>
                                        <i class="fa fa-cog text-md"></i>编辑资料
                                    </a>
                                </li>
                                <li>
                                    <a id="logout" class="button"  href="javascript:void(0)" data-lang-logout="你确定要退出吗？" data-url="{{route("logout")}}">
                                        <i class="fa fa-sign-out text-md"></i>退出
                                    </a>
                                    <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">
                                        {{csrf_field()}}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <a href="{{route('register')}}" class="btn btn-default btn-sm register-btn" data-pjax>
                                注册
                        </a>
                        <a href="{{route('login')}}" class="btn btn-primary btn-sm login-btn" data-pjax>
                                登录
                        </a>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>