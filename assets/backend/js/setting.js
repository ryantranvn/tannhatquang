
// meta
    $('input[name="page_title"]').limit('255','#page_title_limit');
    $('input[name="meta_desc"]').limit('255','#meta_desc_limit');

    var $validator = $("#frmEditMeta").validate({
        rules: {
            page_title: {
                required: true,
                maxlength : 255
            },
            meta_key: {
                required: true
            },
            meta_desc: {
                required : true,
                maxlength : 255
            }
        },
        messages: {
            page_title: {
                required : "Page Title is required",
                maxlength : "Maximum is 255 characters"
            },
            meta_key: {
                required : "Meta Keyword is required"
            },
            meta_desc: {
                required : "Meta Description is required",
                maxlength : "Maximum is 255 characters",
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
