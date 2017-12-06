// Check and uncheck list
$(".checkbox-toggle").click(function () {
    var clicks = $(this).data('clicks');
    if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
    } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
    }
    $(this).data("clicks", !clicks);
});

//Handle starring for glyphicon and font awesome
$(".js-status").click(function (e) {
    e.preventDefault();
    //detect type
    var $this = $(this);
    var id = $this.data('id');
    var status = $this.data('val') ? 0 : 1;
    var $tag =$this.find("i");
    var $configTag = $('#js-page-parameters');
    var url = $configTag.data('url');
    var token = $configTag.data('token');
    if (!id || !url || !token) {
        return false;
    }

    $.ajax({
        url: url + '/status',
        method: "POST",
        data: {
            'id': id,
            'status': status,
            '_token': token
        },
        dataType: 'JSON',
        success: function (response) {
            if (response.success) {
                $this.data('val', status);

                //Switch states
                var glyph = $tag.hasClass("glyphicon");
                var fa = $tag.hasClass("fa");

                if (glyph) {
                    $tag.toggleClass("glyphicon-star");
                    $tag.toggleClass("glyphicon-star-empty");
                }

                if (fa) {
                    $tag.toggleClass("fa-check");
                    $tag.toggleClass("fa-ban");
                }

                $tag.toggleClass("text-green");
                $tag.toggleClass("text-red");

                notyAlert('Статус изменен', 'success', 700);
            } else {
                notyAlert(response.message ? response.message : 'Ошибка', 'error');
            }
        },
        error: function () {
            notyAlert('Ошибка связи', 'error');
        }
    });

});