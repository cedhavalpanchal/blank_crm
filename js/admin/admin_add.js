$('form').validate({
    onkeyup: false,
    rules: {
        first_name: {
            required: true,
            maxlength: 100,
            minlength: 2,
        },
        last_name: {
            required: true,
            maxlength: 100,
            minlength: 2,
        },
        email: {
            required: true
        },
        mobile: {
            maxlength: 10,
            minlength: 10,
        },
        password: {
            required: true,
            minlength: 6
        },
        npassword: {
            required: true,
            minlength: 6,
            equalTo: "#password"
        }
    },
    messages: {
        first_name: {
            required: 'First Name cannot be blank',
        },
        last_name: {
            required: 'Last Name cannot be blank',
        },
        email: {
            required: 'Email cannot be blank',
        },
        state: {
            required: 'State cannot be blank',
        },
        mobile: {
            maxlength: "Please enter 10 digit number.",
            minlength: "Please enter 10 digit number.",
        },
        password: {
            required: 'Password cannot be blank',
            minlength: "Please enter minimum 6 digit.",
        },
        npassword: {
            required: 'Confirm Password cannot be blank',
            minlength: "Please enter minimum 6 digit.",
            equalTo: "Confirm password should be match to password"
        }
    }
});

function setdefaultdata() {
    var flag = 1;
    var email = $('#email').val();
    var user_id = $('#exiting_id').val();
    if ($('form').parsley().isValid()) {
        $.ajax({
            type: "GET",
            url: base_url + "/check_email",
            dataType: 'json',
            async: false,
            data: {
                'email': email,
                'user_id': user_id
            },
            success: function(data) {
                if (data == false) {
                    $('#email').focus();
                    $('#save').attr('disabled', 'disabled');
                    $.confirm({
                        'title': 'Alert',
                        'message': " <strong>Email already exists.<strong></strong>",
                        'buttons': {
                            'ok': {
                                'class': 'btn_center alert_ok',
                                'action': function() {
                                    $('#email').focus();
                                    $('#save').removeAttr('disabled');
                                    $('#email').val('');
                                }
                            }
                        }
                    });
                    flag = 2;
                }
            }
        });
    }
    $("form").parsley().destroy();
    $("form").parsley();
    if (flag == 2) {
        return false;
    } else {
        if ($('form').parsley().isValid()) {
            $('form').block({
                message: 'Loading...'
            });
        } else {
            $('form').submit();
        }
    }
}

function showimagepreview(input) {
    var arr1 = input.files[0]['name'].split('.');
    var arr = arr1[arr1.length - 1].toLowerCase();
    if (arr == 'jpg' || arr == 'jpeg' || arr == 'png' || arr == 'gif') {
        var filerdr = new FileReader();
        filerdr.onload = function(e) {
            $('#uploadPreview1').attr('src', e.target.result);
            $('#uploadPreview1').show();
            $('#delete_btn').show();
        };
        filerdr.readAsDataURL(input.files[0]);
    } else {
        $.confirm({
            'title': 'CONFIRM',
            'message': " <strong> Please upload jpg | jpeg | png | gif file only </strong>",
            'buttons': {
                'Ok': {
                    'class': 'btn_center alert_ok',
                    'action': function() {
                        $("#profile_pic").val('');
                        $old_image_name = $("#oldfile1").val();
                        if ($old_image_name != '') {
                            $("#uploadPreview1").attr("src", admin_img + $old_image_name);
                        } else {
                            $("#uploadPreview1").attr("src", no_img);
                        }
                    }
                }
            }
        });
        return false;
    }
}

function delete_image(id, image) {
    $.confirm({
        'title': 'DELETE',
        'message': " <strong> Do you want to remove image?",
        'buttons': {
            'Yes': {
                'class': '',
                'action': function() {
                    $("#profile_pic").val('');
                    $("#uploadPreview1").attr("src", no_img);
                    $('#uploadPreview1').hide();
                    $('#delete_btn').hide();
                    $("#oldfile1").val('');
                    return false;
                }
            },
            'No': {
                'class': 'special'
            }
        }
    });
}