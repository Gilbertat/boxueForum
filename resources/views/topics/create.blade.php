@extends('layouts.default')
@section('title', '发布帖子')
<style>
   #global_search_btn {
       top: 10px !important;
   }
   #global_search_form {
       margin-bottom: 0px !important;
   }
</style>
    @section('content')
        <div class="row">
            <div class="col-md-12">
                @include('shared.errors')
                <form action="{{route('topic.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="请填写标题" required>
                    </div>
                    <div class="form-group">
                        <select name="category_id" id="category_select" class="form-control" required>
                            <option value disabled selected>请选择分类</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group topic-create">
                        <textarea name="editor" id="editor"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">发布话题</button>
                </form>
            </div>
        </div>
    @stop
@section('script')
    <script src="{{asset('js/inline-attachment.js')}}"></script>
    <script src="{{asset('js/jquery.inline-attachment.js')}}"></script>
    <script type="text/javascript">

        $('.CodeMirror-scroll').css('min-height', 50);

        $(document).ready(function () {
            var options = {
                uploadUrl: '{{route('topic.attachment')}}',
                uploadFieldName: 'image',
                urlText: "\n ![file]({filename}) \n\n",
                extraParams: {
                    '_token': '{{csrf_token()}}',
                }
            };

            $('textarea').inlineattachment(options);

            var mdEditor = new SimpleMDE({
                element: $("#editor")[0],
                toolbar: false,
                height: 600,
            });
        })

    </script>
@stop
