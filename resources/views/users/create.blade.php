@extends('layouts.default')
@section('title', '注册')

    @section('content')
        <div class="row">
            <div class="col-md-4 col-md-offset-4 floating-box">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">注册</h3>
                    </div>
                    <div class="panel-body">
                        @include('shared.errors')
                        @include('users._register_form')
                    </div>
                </div>
            </div>
        </div>
    @endsection