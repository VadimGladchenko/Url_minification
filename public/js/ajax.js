$(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('form').submit(function (event) {
        event.preventDefault();

        if ($(this).valid()) {

            var shortUrl = null;
            var expiredDate = null;

            if ($("#is_custom_link").prop('checked')) {
                shortUrl = $('input[name=short_url]').val();
            }
            if ($("#is_expired_date").prop('checked')) {
                expiredDate = $('#expired_date').val();
            }

            var formData = {
                base_url: $('input[name=base_url]').val(),
                short_url: shortUrl,
                expired_date: expiredDate
            };

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                },
                url: '/create_short_link',
                type: 'POST',
                data: JSON.stringify(formData),
                dataType: 'json',
                contentType: 'application/json',
                success: function (data) {
                    if (data.status === 'success') {
                        $("#results_error_block").css("display", "none");
                        $("#results_info_block").css("display", "block");
                        $("#result_short_url").val(data.short_url);
                        $("#result_statistic_url").val(data.statistic_url);
                    } else if (data.status === 'error') {
                        $("#results_info_block").css("display", "none");
                        $("#results_error_block").css("display", "block");
                        $("#result_error").text(data.message);
                    }
                }
            });
        }
    });
});
