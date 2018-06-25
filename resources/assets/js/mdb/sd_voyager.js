$(document).ready(function () {
    var ps = $('#notification-scroll');
    ps.perfectScrollbar();

    $(document).on( 'init.dt', function ( e, settings ) {
        $('select[name="dataTable_length"]').material_select();
    } );
});




