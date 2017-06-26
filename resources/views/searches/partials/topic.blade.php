<div class="result">
    <h2 class="title">
        <a href="{{$topic->slug}}">{{ $topic->title }}</a>
    </h2>
    <div class="info">
        <span class="date" title="Last Updated at">
            <a href="{{route('users.show', $topic->user_id)}}" data-pjax>{{$topic->user->name}}</a>
            ⋅
          {{ Carbon\Carbon::parse($topic->created_at)->format('Y-m-d') }}

            ⋅
      <i class="fa fa-eye"></i> {{ $topic->view_count }}
            ⋅
      <i class="fa fa-thumbs-o-up"></i> {{ $topic->vote_count }}
            ⋅
      <i class="fa fa-comments-o"></i> {{ $topic->reply_count }}

      </span>

    </div>
    <div class="desc">
        {{ str_limit($topic->content_raw, 250) }}
    </div>
    <hr>
</div>
