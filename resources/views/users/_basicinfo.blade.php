<div class="box">
    <div class="padding-sm user-basic-info">
        <div style="">
            <div class="media">
                <div class="media-left">
                    <div class="image">
                        <a href="{{route('users.edit_avatar', $user->id)}}" class="popover-with-html" data-content="修改头像">
                            <img src="{{$user->present()->gravatar(200)}}" alt="{{$user->name}}" class="media-object avatar-112 avatar img-thumbnail"/>
                        </a>
                    </div>
                </div>
                <div class="media-body">
                    <h3 class="media-heading">
                        {{$user->name}}
                    </h3>
                    <div class="item">
                        第{{$user->id}}位会员
                    </div>
                    <div class="item number">
                        注册于<span class="timeago">{{$user->created_at->diffForHumans()}}</span>
                    </div>
                    @if($user->last_actived_at)
                        <div class="item number">
                            活跃于 <span class="timeago">{{$user->last_activied_at}}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <hr>
        <div class="follow-info row">
            <div class="col-xs-6">
                <a href="{{route('users.followers', [$user->id])}}" class="counter">{{$user->follower_count}}</a>
                <span class="text">关注者</span>
            </div>
            <div class="col-xs-6">
                <a href="{{route('users.topics', [$user->id])}}" class="counter">{{$user->topic_count}}</a>
                <span class="text">话题</span>
            </div>
        </div>
        <hr>
        @if(Auth::user()->id == $user->id)
            <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-block">
                <i class="fa fa-edit"></i>编辑个人资料
            </a>
        @else
            @include('users.partials.follow_form')
        @endif
    </div>
</div>