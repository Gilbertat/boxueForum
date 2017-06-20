<div class="panel panel-default corner-radius">
    <div class="panel-heading text-center">
        <h3 class="panel-title">作者:{{$user->name}}</h3>
    </div>
    <div class="panel-body text-center topic-author-box">
        <a href="{{route('users.show', $user->id)}}">
            <img src="{{$user->present()->gravatar}}" alt="{{$user->name}}" style="width: 80px; height: 80px; margin: 5px;" class="img-thumbnail avatar">
        </a>
        <span class="text-white">
            <hr>
            @if(Auth::user()->id == $user->id)
                <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-block">
                <i class="fa fa-edit"></i>编辑个人资料
            </a>
            @else
                @include('users.partials.follow_form')
            @endif
        </span>
    </div>
</div>

@if(isset($topics))
<div class="panel panel-default corner-radius">
    <div class="panel-heading text-center">
        <h3 class="panel-title">{{$user->name}}的其他话题</h3>
    </div>
    <div class="panel-body text-left">
        <ul class="list-group about-topics">
            @foreach($topics as $topic)
                <li class="list-group-item">
                    <div class="media-heading">
                        <a href="{{$topic->slug}}" title="{{$topic->title}}">
                            {{$topic->title}}
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif