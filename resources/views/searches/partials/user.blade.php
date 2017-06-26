<div class="result user media">
    <div class="media">
        <div class="avatar media-left">
            <div class="image"><a title="{{ $user->name }}" href="{{ route('users.show', $user->id) }}">
                    <img class="media-object img-thumbnail avatar avatar-66" src="{{ $user->present()->gravatar }}" alt="{{$user->name}}"></a>
            </div>
        </div>
        <div class="media-body user-info">
            <div class="info">
                <a href="{{ route('users.show', $user->id) }}" data-pjax>
                    {{ $user->name }}
                </a>
            </div>
            <div class="info number">
                第 {{ $user->id }} 位会员
                ⋅
                <span title="注册日期">
            {{ Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}
        </span>
                ⋅ <span>{{ $user->follower_count }}</span> 关注者
                ⋅ <span>{{ $user->topic_count }}</span> 篇话题
            </div>
        </div>
    </div>

</div>
<hr>
