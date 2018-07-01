
<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
<span>
    <small>
        {{ $notification['data']['user']['name']  }} - {{ $notification['data']['user']['email'] }}
    </small>
    <br>
    <i class="fa fa-envelope mr-2"></i>
    {{ $notification['data']['msg']  }}
</span>
<span class="float-right text-muted text-sm">
    <small>
        <i class="fa fa-clock-o" aria-hidden="true"></i>
        {{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}
    </small>
</span>
