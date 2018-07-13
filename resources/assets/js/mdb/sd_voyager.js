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

function imageB4Uploadfile(fileList,id) {
    if(fileList.length > 0){
        var img = document.getElementById(id);
        img.src = window.URL.createObjectURL(fileList[0]);
        //img.width = 'auto';
        img.onload = function() {
            window.URL.revokeObjectURL(this.src);
        }
    }
}



$(document).ready(function () {
    $(".form-edit-add").submit(function (e) {
        e.preventDefault();

        var url = $(this).attr('action');
        var form = $(this);
        var data = new FormData();

        // Safari 11.1 Bug
        // Filter out empty file just before the Ajax request
        // https://stackoverflow.com/questions/49672992/ajax-request-fails-when-sending-formdata-including-empty-file-input-in-safari
        for (i = 0; i < this.elements.length; i++) {
            if (this.elements[i].type == 'file') {
                if (this.elements[i].value == '') {
                    continue;
                }
            }
            data.append(this.elements[i].name, this.elements[i].value)
        }

        data.set('_validate', '1');

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,

            beforeSend: function () {
                $("body").css("cursor", "progress");
                $(".has-error").removeClass("has-error");
                $(".help-block").remove();
            },

            success: function (d) {
                $("body").css("cursor", "auto");
                $.each(d.errors, function (inputName, errorMessage) {

                    // This will work also for fields with brackets in the name, ie. name="image[]
                    var $inputElement = $("[name='" + inputName + "']"),
                        inputElementPosition = $inputElement.first().parent().offset().top,
                        navbarHeight = $('nav.navbar').height();

                    // Scroll to first error
                    if (Object.keys(d.errors).indexOf(inputName) === 0) {
                        $('html, body').animate({
                            scrollTop: inputElementPosition - navbarHeight + 'px'
                        }, 'fast');
                    }

                    // Hightlight and show the error message
                    $inputElement.parent()
                        .addClass("has-error")
                        .append("<span class='help-block' style='color:#f96868'>" + errorMessage + "</span>")

                });
            },

            error: function () {
                $(form).unbind("submit").submit();
            }
        });
    });
});






