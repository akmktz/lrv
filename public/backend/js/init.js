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
    })
});