<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" href="{{ url("/") }}">
                <i class="fa fa-home"></i>
                Home
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
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
                <div style="overflow-y: scroll; height : 350px" id="notification-scroll" >
                @foreach($notifications->get() as $notification)
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('voyager.notification.read',['id'=>$notification->id]) }}" class="dropdown-item">
                            @include("voyager::notifications.".snake_case(class_basename($notification->type)) , $notification )
                        </a>
                @endforeach
                </div>
                <a href="{{ route('voyager.notification.all') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{ $user_avatar }}" class="img-fluid rounded-circle" width="30px">
                <i class="fa fa-caret-down" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-item text-center">
                    <img src="{{ $user_avatar }}" class="img-fluid rounded-circle" width="200px" >
                    <div class="profile-body ">
                        <h5>
                            {{ ucfirst(Auth::user()->name) }}<br>
                            <small>{{ Auth::user()->email }}</small>
                        </h5>
                    </div>
                </div>
                <span class="dropdown-item dropdown-header">
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
                               class=" dropdown-item {{ isset($item['classes']) && !empty($item['classes']) ? $item['classes'] : '' }}" >
                                @if(isset($item['icon_class']) && !empty($item['icon_class']))
                                    <i class="{!! $item['icon_class'] !!}"></i>
                                @endif
                                {{$name}}
                            </a>
                        @endif
                    @endforeach
                @endif
                <a href="#" class="dropdown-item dropdown-footer">
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