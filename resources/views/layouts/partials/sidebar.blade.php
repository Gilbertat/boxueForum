
<div class="col-md-3 side-bar">
    @if(Auth::check())
      <div class="panel panel-default corner-radius">
          <div class="panel-body text-center create-topic">
              <a class="button" href="{{route('topic.create')}}">
                  <i class="fa fa-plus text-md"></i>创建话题
              </a>
          </div>
      </div>
    @endif
    
    @if(isset($post))
    <div class="panel panel-default corner-radius">
        <div class="panel-heading text-center">
            <h3 class="panel-title">泊学公告</h3>
        </div>
        <div class="panel-body text-center">
            @if(count($post))
                <b style="display: block; margin-bottom: 10px;">{{$post->content}}</b>
                <span style="float: right;">
                    {{$post->updated_at->diffForHumans()}}
                </span>
                @else
                <span>暂无公告</span>
            @endif
        </div>
    </div>
    @endif

    <div class="panel panel-default  corner-radius sidebar-resources">
        <div class="panel-heading text-center">
            <h3 class="panel-title">相关链接</h3>
        </div>
        <div class="panel-body text-center">
            <a href="https://boxueio.com/" target="_blank" title="泊学" style=" color: #737373;">
                <span style="margin-top: 7px; display: inline-block;">
                    <i class="fa fa-heart" aria-hidden="true" style="color: rgba(232, 146, 136, 0.89);"></i>泊学-我们都爱他
                </span>
            </a>
        </div>
    </div>

    <div class="panel panel-default corner-radius" style="color: #a5a5a5;">
        <div class="panel-heading text-center">
            <h3 class="panel-title">反馈</h3>
        </div>
        <div class="panel-body text-center">
            <a href="mailto:syloveql@gmail.com" style="color: #a5a5a5;">
                <span style="margin-top: 7px; display: inline-block;">
                    建议与反馈
                </span>
            </a>
        </div>
    </div>

    @if(isset($categories))
        <div class="panel panel-default corner-radius">
            <div class="panel-heading text-center">
                <h3 class="panel-title">话题分类</h3>
            </div>
            <div class="panel-body text-center pills">
                @foreach($categories as $category)
                    <a href="{{route('categories.show', $category->id)}}" title="{{$category->description}}">{{$category->title}}</a>
                @endforeach
            </div>
        </div>

    @endif

</div>