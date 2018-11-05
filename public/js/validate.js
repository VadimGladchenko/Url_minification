jQuery.validator.setDefaults({
    debug: false,
    success: "valid"
});
$("#url_form").validate({
    rules: {
        base_url: {
            required: true,
            url: true
        },
        short_url: {
            required: true
        }
    }
});

