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
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('page_header')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @if(count(Request::segments()) == 1)
                                    <li class="breadcrumb-item active">
                                        <span>{{ __('voyager::generic.dashboard') }}</span>
                                    </li>
                                @else
                                    <li class="breadcrumb-item active">
                                        <a href="{{ route('voyager.dashboard')}}" >
                                            <span>{{ __('voyager::generic.dashboard') }}</span>
                                        </a>
                                    </li>
                                @endif
                                <?php $breadcrumb_url = url(''); ?>
                                @for($i = 1; $i <= count(Request::segments()); $i++)
                                    <?php $breadcrumb_url .= '/' . Request::segment($i); ?>
                                    @if(Request::segment($i) != ltrim(route('voyager.dashboard', [], false), '/') && !is_numeric(Request::segment($i)))
                                        @if($i < count(Request::segments()) & $i > 0 && array_search('database',Request::segments())===false)
                                            <li class="breadcrumb-item active ">
                                                <a href="{{ $breadcrumb_url }}" >{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}</a>
                                            </li>
                                        @else
                                            <li class="breadcrumb-item">{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}</li>
                                        @endif
                                    @endif
                                @endfor
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
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
