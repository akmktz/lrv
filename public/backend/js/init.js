// Notify
function notyAlert(message, type, timeout) {
    new Noty({
        text: message,
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

    //CK Editor
    $(function () {
        $('textarea.ck-editor').each(function (id, el) {
            var $this = $(el),
                id = $this.id;
            CKEDITOR.replace(id ? id : $this.attr('name'));
        });
    });

    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });


});