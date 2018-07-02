@extends('voyager::lte.master')

@section('master_css')
    @stack('css')
    @yield('css')
@stop

@section('body_class', '')

@section('body')
    <div class="wrapper">

        <!-- Main Header -->

        @php
        if (starts_with(Auth::user()->avatar, 'http://') || starts_with(Auth::user()->avatar, 'https://')) {
            $user_avatar = Auth::user()->avatar;
        } else {
            $user_avatar = Voyager::image(Auth::user()->avatar);
        }
        $admin_logo_img = Voyager::setting('admin.icon_image', '');
        if ($admin_logo_img == '') $admin_logo_img = voyager_asset('images/logo-icon-light.png');
        else $admin_logo_img = Voyager::image($admin_logo_img);
        @endphp

        @include('voyager::lte.layout.navbar')
        @include('voyager::lte.layout.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                <div class="py-3">
                    @yield('page_header')
                </div>
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
        </div>

        @include('voyager::lte.layout.footer')

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
@endsection

@section('master_js')
    @stack('javascript')
    @yield('javascript')
@stop
