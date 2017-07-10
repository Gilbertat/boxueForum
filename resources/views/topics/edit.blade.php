@extends('layouts.default')

@section('title', '编辑话题')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('shared.errors')
            <form action="{{route('topic.update', $topic->id)}}" method="post" style="margin-bottom: 1em;">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="请填写标题" required
                           value="{{$topic->title}}">
                </div>
                <div class="form-group">
                    <select name="category_id" id="category_select" class="form-control" required>
                        <option value="{{$topic->category_id}}" selected>{{$topic->category->title}}</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group topic-edit">
                    <textarea name="editor" id="editor">{{$topic->content_raw}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">保存更改</button>
            </form>
        </div>
    </div>
@stop

@section('script')
    <script src="{{asset('js/inline-attachment.js')}}"></script>
    <script src="{{asset('js/codemirror-4.inline-attachment.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function ()
        {

            var options = {
                uploadUrl: '{{route('topic.attachment')}}',
                uploadFieldName: 'image',
                urlText: "\n ![file]({filename}) \n\n",
                extraParams: {
                    '_token': '{{csrf_token()}}',
                }
            };

            var mdEditor = new SimpleMDE({
                element: $("#editor")[0],
                toolbar: false,
            });

            inlineAttachment.editors.codemirror4.attach(mdEditor.codemirror, options);

        });
    </script>
@stop