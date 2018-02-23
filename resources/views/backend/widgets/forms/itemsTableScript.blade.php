<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Add or save
        $('.js-items-table').on('click', '.js-save-btn', function () {
            var $table = $(this).closest('.js-items-table');
            var $tableRow = $(this).closest('tr');
            if (!$table.length || !$tableRow.length) {
                return;
            }

            var url= $table.data('url');
            var id = $tableRow.data('id');
            var data = {
                id: id,
                _token: '{{csrf_token()}}'
            };
            $tableRow.find('input').each(function () {
                var $this, type, name, value;
                $this = $(this);
                type = $this.prop('type');
                if (type === 'submit' || type === 'reset' || type === 'button') {
                    return true;
                }

                name = $this.attr('name');
                if (type === 'checkbox') {
                    value = $this.prop('checked');
                } else {
                    value = $this.val();
                    if (!id && type !== 'hidden') {
                        $this.val('');
                    }
                }
                data[name] = value;

            });

            myAjax(url, data, $table);
        });

        // Delete
        $('.js-items-table').on('click', '.js-del-btn', function () {
            if (!confirm('Вы точно хотите удалить данную строку?')) {
                return;
            }

            var $table = $(this).closest('.js-items-table');
            var $tableRow = $(this).closest('tr');
            if (!$table.length || !$tableRow.length) {
                return;
            }

            var url= $table.data('del-url');
            var data = {
                id: $tableRow.data('id'),
                _token: '{{csrf_token()}}'
            };

            myAjax(url, data, $table);
        });

        function myAjax(url, data, $table) {
            $.ajax({
                url: url,
                method: "POST",
                data: data,
                dataType: 'JSON',
                success: function (response) {
                    if (response.success) {
                        if (response.html !== undefined) {
                            var $tableBody = $table.find('.js-items-table-body');
                            if (!$tableBody.length) {
                                return;
                            }
                            $tableBody.html(response.html);
                        }
                        if (response.message) {
                            notyAlert(response.message, 'alert', 1000);
                        }
                    } else {
                        notyAlert(response.message ? response.message : 'Ошибка', 'error');
                    }
                },
                error: function () {
                    notyAlert('Ошибка связи', 'error');
                }
            });
        }
    });
</script>