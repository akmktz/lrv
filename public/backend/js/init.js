// Notify
function notyAlert(message, type, timeout) {
    new Noty({
        text: String(message).replace("\n", "<br>\n"),
        type: (type ? type : 'alert'),
        timeout: (timeout ? timeout : 7000),
        closeWith: ['click'],
        progressBar: true,
        layout: 'bottomRight'
    }).show();
}

$(function () {
    // Popover
    $('[data-toggle="popover"]').popover();

    // CK Editor
    $(function () {
        $('textarea.ck-editor').each(function (id, el) {
            var $this = $(el),
                id = $this.id;
            CKEDITOR.replace(id ? id : $this.attr('name'));
        });
    });

    // Enable iCheck plugin for checkboxes
    // iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

    // Nestable2
    $('.dd').nestable({
        callback: function(l, e, p){
            var $configTag = $('#js-page-parameters');
            if (!$configTag.length) {
                return false;
            }

            var url = $configTag.data('url');
            var data = l.nestable('serialize');
            var token = $configTag.data('token');
            if (!url || !data || !token) {
                return false;
            }

            $.ajax({
                url: url + '/sort',
                method: "POST",
                data: {
                    'data': data,
                    '_token': token
                },
                dataType: 'JSON',
                success: function (response) {
                    if (!response.success) {
                        notyAlert(response.message ? response.message : 'Ошибка', 'error');
                    }
                },
                error: function () {
                    notyAlert('Ошибка связи', 'error');
                }
            });
        }
    });


});