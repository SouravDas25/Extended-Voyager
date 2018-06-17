$(document).ready(function () {
    var ps = $('#notification-scroll');
    ps.perfectScrollbar();

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
                        var elm = "<a class='list-group-item ' href='"+ item.data.link + "'>"
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




