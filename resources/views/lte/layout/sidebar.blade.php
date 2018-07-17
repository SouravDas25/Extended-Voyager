<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('voyager.dashboard') }}" class="brand-link">
        <img src="{{ $admin_logo_img }}" alt="Voyager Logo" class="brand-image img-circle "
             style="opacity: .8">
        <span class="brand-text font-weight-bold pl-2 text-uppercase">{{Voyager::setting('admin.title', 'VOYAGER')}}</span>
    </a>

<!-- Sidebar -->
    <div class="sidebar scrollbar-near-moon thin">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image ">
                <img src="{{ $user_avatar }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('voyager.profile') }}" class="d-block">
                    {{ ucwords(Auth::user()->name) }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            {!! menu('admin', 'voyager::menu.lte') !!}
        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>