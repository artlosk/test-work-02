$(document).ready(function () {
    $('form').submit(function (event) {
        var json;
        event.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                json = jQuery.parseJSON(result);
                if (json.url) {
                    window.location.href = '/' + json.url;
                } else {
                    if(json.status == 'error') {
                        $.each(json.fields, function (index, value) {
                            $('.form-group').find('#' + index).addClass('is-invalid');
                            $('.form-group').find('#' + index).parent().find('.invalid-feedback').html(value);
                        });
                    }
                    //todo for error summary
                    //alert(json.status + ' - ' + json.message);
                }
            },
        });
    });

    $('.form-control').on('click', function() {
        $(this).removeClass('is-invalid');
        $(this).closest('.form-group').find('.invalid-feedback').html('');
    });

    $('#confirmDelete').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
    });
});