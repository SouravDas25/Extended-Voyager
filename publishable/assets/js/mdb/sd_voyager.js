$(document).ready(function () {
    var ps = $('#notification-scroll');
    ps.perfectScrollbar();
    /*var loadingCount = 0;
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
    ps.on('ps-y-reach-end', function (event) {
        loadingCount++;
        if (loadingCount > 3 && loading === false) {
            startLoader();
            addPSNotificationEntries(ps.data('href'));
        }
        });

    function addPSNotificationEntries(href) {
        $.get(href,function (data) {
            //console.log(data);
            if(data.data){
                data.data.forEach(function (item, key) {
                    var elm = "<a class=' ' style=\"width: 100%\">"
                        + item +
                        "</a>";
                    ps.append(elm);
                });
            }
            ps.data('href',data.next_page_url);
            //ps.perfectScrollbar();
            stopLoader();
        })
    }

    addPSNotificationEntries(ps.data('href'));*/
});




