@extends('voyager::master')

@section('page_title', "All Notifications")

@section('css')
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="fa fa-bell"></i>
        All Notifications
    </h1>
    <a class="btn btn-primary" href="{{ route('voyager.notification.mark-all') }}">
        Mark all As Read
    </a>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="list-group" data-href="{{ route('voyager.notification.api.all') }}" id="notification-all">
        </div>
    </div>
    <div class="text-center" id="notification-loader" style="display: none">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-red-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('document').ready(function () {

        });
    </script>
@stop