@foreach(['danger', 'warning', 'success', 'info', 'status'] as $msg)
    @if(session()->has($msg))
        <div class="flash-message">
            <p class="alert alert-{{$msg}}">
                {{session()->get($msg)}}
            </p>
        </div>
        {{--<script>--}}
            {{--swal({--}}
                {{--title: "{{session()->get($msg)}}",--}}
                {{--type: "success",--}}
                {{--timer: 1700,--}}
                {{--showConfirmButton: false,--}}
                {{--html: true--}}
            {{--});--}}
        {{--</script>--}}
    @endif
@endforeach