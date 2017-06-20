<ul class="list-group">
    @foreach($topics as $topic)
        <li class="list-group-item">
            <a href="{{$topic->slug}}" title="{{$topic->title}}" class="title">
                {{str_limit($topic->title, '100')}}
            </a>
            <span class="meta">
               <a href="{{route('categories.show', [$topic->category_id])}}" title="{{$topic->category->title}}">
                   {{$topic->category->title}}
               </a>
                <span> . </span>
                {{$topic->view_count}}查看
                <span> . </span>
                {{$topic->reply_count}}回复
                <span> . </span>
                <span class="timeago" title="{{$topic->created_at}}">{{$topic->created_at->diffForHumans()}}</span>
            </span>
        </li>
    @endforeach
</ul>