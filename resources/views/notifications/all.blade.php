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
        $(document).ready(function () {
            var na = $('#notification-all');
            na.perfectScrollbar();
            var loadingCount = 0;
            var loading = false;
            var loader = '#notification-loader';

            function stopLoader() {
                $(loader).hide();
                loadingCount = 0;
                loading = false;
            }
            function startLoader() {
                $(loader).show();
                loadingCount = 0;
                loading = true;
            }
            //document.getElementById('notification-scroll')
            na.on('ps-y-reach-end', function (event) {
                loadingCount++;
                if (loadingCount > 13 && loading === false) {
                    startLoader();
                    addPSNotificationEntries(na.data('href'));
                }
            });

            var done = false;

            function addPSNotificationEntries(href) {
                if(href != null) {
                    $.get(href,function (data) {
                        console.log(data);
                        if(data.data){
                            data.data.forEach(function (item, key) {
                                var color = (item.read_at === null) ? "indigo lighten-5" : "" ;
                                var elm = "<a class='list-group-item "+ color +"' href='"+ item.data.link + "'>"
                                    + item.view +
                                    "</a>";
                                na.append(elm);
                            });
                        }
                        na.data('href',data.next_page_url);
                        //ps.perfectScrollbar();
                        stopLoader();
                    })
                }
                else {
                    if(href == null && !done){
                        var elm = "<a class='list-group-item text-center' >"
                            + "No more Notification" +
                            "</a>";
                        na.append(elm);
                        done = true;
                    }
                    stopLoader();
                }

            }

            addPSNotificationEntries(na.data('href'));
        });
    </script>
@stop