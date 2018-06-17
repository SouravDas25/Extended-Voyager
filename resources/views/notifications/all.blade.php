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
        <div class="list-group">
            @foreach(Auth::user()->notifications as $notification)
                <a href="{{ route('voyager.notification.read',['id'=>$notification->id])}}"
                   class="list-group-item {{ $notification->unread() ? 'indigo lighten-5' : ''}}" >
                    @include("voyager::notifications.".snake_case(class_basename($notification->type)) , $notification )
                </a>
            @endforeach
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $('document').ready(function () {

        });
    </script>
@stop