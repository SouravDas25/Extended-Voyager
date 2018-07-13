
<nav class="navbar navbar-default fixed-top navbar-fixed-top navbar-top " role="navigation" >
    <div class="container">
        <div class="navbar-header ">
            <a class="hamburger btn-link">
                <span class="hamburger-inner"></span>
            </a>
            @section('breadcrumbs')
                <ol class="breadcrumb " style="border: 0" >
                    @if(count(Request::segments()) == 1)
                        <li class="breadcrumb-item active">
                            <i class="voyager-boat"></i>
                            {{ __('voyager::generic.dashboard') }}
                        </li>
                    @else
                        <li class="breadcrumb-item active">
                            <a href="{{ route('voyager.dashboard')}}">
                                <i class="voyager-boat"></i>
                                {{ __('voyager::generic.dashboard') }}
                            </a>
                        </li>
                    @endif
                    <?php $breadcrumb_url = url(''); ?>
                    @for($i = 1; $i <= count(Request::segments()); $i++)
                        <?php $breadcrumb_url .= '/' . Request::segment($i); ?>
                        @if(Request::segment($i) != ltrim(route('voyager.dashboard', [], false), '/') && !is_numeric(Request::segment($i)))

                            @if($i < count(Request::segments()) & $i > 0 && array_search('database',Request::segments())===false)
                                <li class="breadcrumb-item active">
                                    <a href="{{ $breadcrumb_url }}">{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}</a>
                                </li>
                            @else
                                <li class="breadcrumb-item">{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}</li>
                            @endif
                        @endif
                    @endfor
                </ol>
            @show
        </div>
        <ul class="nav navbar-nav nav-flex-icons ml-auto  @if (config('voyager.multilingual.rtl')) navbar-left @else navbar-right @endif">
            <li class="nav-item dropdown notifications-nav" >
                @php $notifications = Auth::user()->unreadNotifications() @endphp
                <a class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    @if( $notifications->count() > 0)
                        <span class="badge red">{{$notifications->count()}}</span>
                    @endif
                    <i class="fa fa-bell"></i>
                    <span class="d-none d-md-inline-block hidden-sm hidden-xs">Notifications</span>
                    <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-info dropdown-menu-right p-2" aria-labelledby="navbarDropdownMenuLink" style="width:250%">
                    <div style="max-height:400px;" id="notification-scroll">
                    @foreach($notifications->get() as $notification)
                    <a class="dropdown-item "
                         href="{{ route('voyager.notification.read',['id'=>$notification->id]) }}"  >
                        @include("voyager::notifications.".snake_case(class_basename($notification->type)) , $notification )
                    </a>
                    @endforeach
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="text-center" href="#" style="width: 100%">
                        <a class="blue-text" href="{{ route('voyager.notification.all') }}">
                            <i class="fa fa-eye mr-2" aria-hidden="true"></i>
                            View all
                        </a>
                    </div>
                </div>
            </li>

            <li class="dropdown" style="border: 0">
                <a href="#" class="nav-link dropdown-toggle text-right  waves-effect" data-toggle="dropdown" role="button"
                   aria-expanded="false">
                    <img src="{{ $user_avatar }}" class="img-fluid rounded-circle" width="30px">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right p-2">
                    <li class="img-fluid">
                        <img src="{{ $user_avatar }}" class="img-fluid" >
                        <div class="profile-body text-center">
                            <h6>{{ Auth::user()->name }}</h6>
                            <h6>{{ Auth::user()->email }}</h6>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <?php $nav_items = config('voyager.dashboard.navbar_items'); ?>
                    @if(is_array($nav_items) && !empty($nav_items))
                        @foreach($nav_items as $name => $item)
                            <li {!! isset($item['classes']) && !empty($item['classes']) ? 'class="'.$item['classes'].'"' : '' !!} >
                                @if(isset($item['route']) && $item['route'] == 'voyager.logout')
                                    <form action="{{ route('voyager.logout') }}" method="POST">
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
                                       class="dropdown-item">
                                        @if(isset($item['icon_class']) && !empty($item['icon_class']))
                                            <i class="{!! $item['icon_class'] !!}"></i>
                                        @endif
                                        {{$name}}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</nav>