$('form').validate({
  onkeyup:true,
  rules: {
        oldpassword: {
            required: true,
        },
        password: {
            required: true,
            normalizer: function (value) {
                return $.trim(value);
            },
            minlength:6,
        },
        cpassword:{
            required: true,
            normalizer: function (value) {
                return $.trim(value);
            },
            equalTo: "#password",
        }
    },
    messages: {
        oldpassword: {
            required: 'Old Password cannot be blank',
        },
        password: {
            required: 'Password cannot be blank',
            minlength: "Password must be at least 6 characters long ",
        },
        cpassword: {
            required: 'Confirm Password cannot be blank',
            equalTo: "Password and Confirm Password should be same.",
        },
    }
});