<div id="slide-out" class="side-nav sn-bg-4 fixed">
    <ul class="custom-scrollbar">
        <li class="h1-responsive">
            <div class="row" href="{{ route('voyager.dashboard') }}">
                <div class="col-4">
                    <?php
                    $admin_logo_img = Voyager::setting('admin.icon_image', '');
                    $admin_logo_img = $admin_logo_img == '' ? voyager_asset('images/logo-icon-light.png') : Voyager::image($admin_logo_img);?>
                    <img src="{{ $admin_logo_img }}" alt="Logo Icon" class="img-fluid p-2 ml-2" style="height: 52px">
                </div>
                <h4 class="col-8 m-auto text-uppercase font-weight-bold">
                    {{Voyager::setting('admin.title', 'VOYAGER')}}
                </h4>
            </div>
        </li>
        <li>
            <div class="row p-2"
                 style="background-image:url({{ Voyager::image( Voyager::setting('admin.bg_image'), voyager_asset('images/bg.jpg') ) }});
                         background-size: cover; background-position: 0px; opacity:0.75">
                <div class="col-4 m-auto ">
                    <img src="{{ $user_avatar }}" class="img-fluid rounded-circle p-2 ml-2"
                         alt="{{ Auth::user()->name }} avatar">
                </div>
                <div class="col-8 m-auto">
                    {{ ucwords(Auth::user()->name) }}<br>
                    <small>{{ Auth::user()->email }}</small>
                </div>
            </div>

        </li>

        <li>
            {!! menu('admin', 'admin_menu') !!}
        </li>


        <div class="sidenav-bg mask-strong"></div>
    </ul>
</div>
