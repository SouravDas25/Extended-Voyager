$(document).ready(function () {

    $(document).on( 'init.dt', function ( e, settings ) {
        $('select[name="dataTable_length"]').material_select();
        $('#dataTable_wrapper').addClass('p-1');
    } );

    $('select.select2').select2({width: '100%'});
    $('select.select2-taggable').select2({
        width: '100%',
        tags: true,
        createTag: function (params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }

            return {
                id: term,
                text: term,
                newTag: true
            }
        }
    }).on('select2:selecting', function (e) {
        var $el = $(this);
        var route = $el.data('route');
        var label = $el.data('label');
        var errorMessage = $el.data('error-message');
        var newTag = e.params.args.data.newTag;

        if (!newTag) return;

        $el.select2('close');

        $.post(route, {
            [label]: e.params.args.data.text,
        }).done(function (data) {
            var newOption = new Option(e.params.args.data.text, data.data.id, false, true);
            $el.append(newOption).trigger('change');
        }).fail(function (error) {
            toastr.error(errorMessage);
        });

        return false;
    });

    $('.match-height').matchHeight();

    $('.datatable').DataTable({
        "dom": '<"top"fl<"clear">>rt<"bottom"ip<"clear">>'
    });


});





