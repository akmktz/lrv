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
            // l is the main container
            // e is the element that was moved
            // console.log('Moved');
            // console.log(l);
            // console.log(p);
            // console.log(e.data('id'));
            // console.log(l.data('id'));
            // console.log(l.nestable('serialize'));
            console.log(l.nestable('toArray'));

            var item;
            var id = e.data('id');
            var data = l.nestable('toArray');
            if (data.length) {
                for (var i = 0 ; i < data.length ; i++) {
                    if (id === data[i].id) {
                        console.log(data[i]);
                    }
                }
            }

            // p.find('.dd-item').each(function (id, item) {
            //     console.log(item);
            // });
            console.log('-------------------------------------------------------');
        }
    });


});