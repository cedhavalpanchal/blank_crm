$('form').validate({
    onkeyup: false,
    rules: {
        sitename: {
            required: true
        },
        admin_email: {
            required: true
        },
        address1: {
            required: true
        },
        contact_number: {
            required: true,
            minlength: 10,
            maxlength: 10,
        },
        contact_email: {
            required: true
        },
        smtp_host: {
            required: true
        },
        smtp_user: {
            required: true
        },
        smtp_pass: {
            required: true
        },
        protocol: {
            required: true
        },
        smtp_port: {
            required: true
        },
        smtp_timeout: {
            required: true
        },
    },
    messages: {
        first_name: {
            required: 'First Name cannot be blank',
        },
        sitename: {
            required: 'Sitename cannot be blank',
        },
        admin_email: {
            required: 'Admin Email cannot be blank',
        },
        address1: {
            required: 'Address cannot be blank',
        },
        contact_number: {
            required: 'Contact Number cannot be blank',
            minlength: 10,
            maxlength: 10,
        },
        contact_email: {
            required: 'Contact Email cannot be blank',
        },
        smtp_host: {
            required: 'SMTP Host cannot be blank',
        },
        smtp_user: {
            required: 'SMPT User cannot be blank',
        },
        smtp_pass: {
            required: 'SMTP Password cannot be blank',
        },
        protocol: {
            required: 'Protocol cannot be blank',
        },
        smtp_port: {
            required: 'SMTP Port cannot be blank',
        },
        smtp_timeout: {
            required: 'SMPT Timout cannot be blank',
        },
    }
});