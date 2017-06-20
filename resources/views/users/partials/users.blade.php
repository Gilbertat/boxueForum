<ul class="list-group">
    @foreach($users as $index => $followUser)
        <li class="list-group-item">
            <a href="{{route('users.show', [$followUser->id])}}" title="{{$followUser->name}}">
                <img class="media-object img-thumbnail avatar avatar-small inline-block" src="{{$followUser->present()->gravatar}}" alt="{{$followUser->name}}">
                {{$followUser->name}}
            </a>
        </li>
    @endforeach
</ul>