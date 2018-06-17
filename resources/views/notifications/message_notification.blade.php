
<i class="fa fa-user mr-2" aria-hidden="true"></i>
<span>
    <strong> {{ $notification['data']['user']['name']  }} - {{ $notification['data']['user']['email'] }}</strong>
    <br>
    {{ $notification['data']['msg']  }}
</span>
<span class="float-right">
    <i class="fa fa-clock-o" aria-hidden="true"></i>
    {{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}
</span>
