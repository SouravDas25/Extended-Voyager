<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        @if(count(Request::segments()) == 1)
            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link" href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ __('voyager::generic.dashboard') }}</span>
                </a>
            </li>
        @else
            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link" href="{{ route('voyager.dashboard')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ __('voyager::generic.dashboard') }}</span>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link px-0" href="#">
                    /
                </a>
            </li>
        @endif
        <?php $breadcrumb_url = url(''); ?>
        @for($i = 1; $i <= count(Request::segments()); $i++)
            <?php $breadcrumb_url .= '/' . Request::segment($i); ?>
            @if(Request::segment($i) != ltrim(route('voyager.dashboard', [], false), '/') && !is_numeric(Request::segment($i)))
                @if($i < count(Request::segments()) & $i > 0 && array_search('database',Request::segments())===false)
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link" href="{{ $breadcrumb_url }}">
                            {{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}
                        </a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link px-0" href="#">
                            /
                        </a>
                    </li>
                @else
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link" href="#">
                            {{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}
                        </a>
                    </li>
                @endif
            @endif
        @endfor
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" href="{{ url("/") }}">
                <i class="fa fa-home"></i>
                Home
            </a>
        </li>
        <!-- Messages Dropdown Menu -->
        <!-- li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-comments-o"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li -->
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            @php $notifications = Auth::user()->unreadNotifications() @endphp
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell-o"></i>
                @if( $notifications->count() > 0)
                    <span class="badge badge-warning navbar-badge">{{$notifications->count()}}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{$notifications->count()}} Notifications</span>
                <div class="scrollbar scrollbar-primary thin">
                    <div class="force-overflow">
                        @foreach($notifications->get() as $notification)
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('voyager.notification.read',['id'=>$notification->id]) }}"
                               class="dropdown-item">
                                @include("voyager::notifications.".snake_case(class_basename($notification->type)) , $notification )
                            </a>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('voyager.notification.all') }}" class="dropdown-item dropdown-footer">See All
                    Notifications</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{ $user_avatar }}" class="img-fluid rounded-circle" width="30px">
                <i class="fa fa-caret-down" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-item text-center disabled">
                    <img src="{{ $user_avatar }}" class="img-fluid rounded-circle" width="100px">
                    <div class="profile-body ">
                        <h5>
                            {{ ucfirst(Auth::user()->name) }}<br>
                            <small>{{ Auth::user()->email }}</small>
                        </h5>
                    </div>
                </div>
                <span class="dropdown-item dropdown-header disabled">
                    Quick Actions
                </span>
                <?php $nav_items = config('voyager.dashboard.navbar_items'); ?>
                @if(is_array($nav_items) && !empty($nav_items))
                    @foreach($nav_items as $name => $item)
                        <div class="dropdown-divider"></div>
                        @if(isset($item['route']) && $item['route'] == 'voyager.logout')
                            <form action="{{ route('voyager.logout') }}" method="POST"
                                  class=" dropdown-item {{ isset($item['classes']) && !empty($item['classes']) ? $item['classes'] : '' }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-block">
                                    @if(isset($item['icon_class']) && !empty($item['icon_class']))
                                        <i class="{!! $item['icon_class'] !!}"></i>
                                    @endif
                                    {{$name}}
                                </button>
                            </form>
                        @else
                            <a href="{{ isset($item['route']) && Route::has($item['route']) ? route($item['route']) : (isset($item['route']) ? $item['route'] : '#') }}"
                               {!! isset($item['target_blank']) && $item['target_blank'] ? 'target="_blank"' : '' !!}
                               class=" dropdown-item {{ isset($item['classes']) && !empty($item['classes']) ? $item['classes'] : '' }}">
                                @if(isset($item['icon_class']) && !empty($item['icon_class']))
                                    <i class="{!! $item['icon_class'] !!}"></i>
                                @endif
                                {{$name}}
                            </a>
                        @endif
                    @endforeach
                @endif
                <a href="#" class="dropdown-item dropdown-footer disabled">
                    Good Day, {{ ucfirst(Auth::user()->name) }}
                </a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                        class="fa fa-th-large"></i></a>
        </li>
    </ul>
</nav>