/*
 @Description: Comman JS Functions
 @Author: Mit Makwana
 @Date: 29-3-2016
 */

$('.decimal_number').keypress(function(event) {
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && ((event.which < 48 || event.which > 57) &&
          (event.which != 0 && event.which != 8)))
    {
        event.preventDefault();
    }

    var text = $(this).val();
      
    if ((text.indexOf('.') != -1) && (text.substring(text.indexOf('.')).length > 4) && (event.which != 0 && event.which != 8) &&
        ($(this)[0].selectionStart >= text.length - 5)) 
    {
        event.preventDefault();
    }
});

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function mobile_valid(evt,id){          
    var charCode = (evt.which) ? evt.which : evt.keyCode 
    var mobile_length = $('#'+id).val().length;

    if (mobile_length == 0 && charCode == 48 )
        return false;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function validlatlong(evt)
{
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && ((charCode > 57 || charCode < 44 || charCode == 47)))
    {
        return false;  
    }
    else
    {
        /* if (contact_no.value.length <13)
        {
        return true;
        }
        else
        {
        return false;
        }*/
        return  true;
    }
}

function cleare_data()
{
    $("#<?php echo $viewname; ?>").parsley().destroy();
    $("#<?php echo $viewname; ?>").parsley();
}

$(document).on('click', '.close-message', function () {
    $('#div_msg').hide('slow');
});

$(document).ready(function () {
    setTimeout(function() {
        $('#div_msg').hide('slow');
    }, 5000); 
});


function create_slug(pagetitle,idName)
{
    var string=pagetitle.toLowerCase();
    string=string.replace(/[^a-zA-Z 0-9_\s-]+/g,'');
    string=string.replace(/[\s-]+/g,' ');
    string=string.replace(/[\s_]+/g,'-');
    $('#'+idName).val(string);

    $('#'+idName).parsley().destroy();
    $('#'+idName).parsley();
}

function csv_test(input) 
{
    var arr1    = input.files[0]['name'].split('.');
    var arr     = arr1[arr1.length-1].toLowerCase(); 

    if(arr == 'csv')
    {
        $('#hiddenFiledoc_csv').val(arr1[1]);
    }
    else
    {
        $.confirm({'title': 'Alert','message': " <strong> Please upload .csv file only "+"<strong></strong>",'buttons': {'ok'   : {'class'  : 'btn_center alert_ok'}}});
        $('#reset').css('display','block');
        $('#reset').trigger('click');
        $('#reset').css('display','none');
        $('#postcode_management_csv').trigger('reset');
        $('#hiddenFiledoc_csv').val('');
        $('#csv_file').val('');
        return false;
    }   
}

function excel_test(input) 
{
    //var maximum = input.files[0].size/1024;
    //alert(maximum);
    if (input.files && input.files[0]) 
    {
        var arr1    = input.files[0]['name'].split('.');
        var arr     = arr1[arr1.length-1].toLowerCase(); 


        if(arr == 'xlsx' || arr == 'xls')
        {
            $('#hiddenFiledoc').val(arr1[1]);
        }
        else
        {
            $.confirm({'title': 'Alert','message': " <strong> Please upload .xlsx or .xls file only "+"<strong></strong>",'buttons': {'ok'  : {'class'  : 'btn_center alert_ok'}}});
            $('#hiddenFiledoc').val('');
            $('#excel_file').val('');
            return false;
        }   
    }
    else
    {
        $.confirm({'title': 'Alert','message': " <strong> Maximum upload size 2 MB "+"<strong></strong>",'buttons': {'ok'   : {'class'  : 'btn_center alert_ok'}}});
            return false;
    }
}

function CheckPassword(inputtxt)
{
    var decimal=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,15}$/;

    if(String(inputtxt).match(decimal))
    {
        //alert('Correct, try another...')
        //return true;
    }
    else
    {
        $.confirm({'title': 'Alert', 'message': "<strong>Password must be between 7 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character.</strong>", 'buttons': {'ok': {'class': 'btn_center'}}});
        $('#password').val('');
        return false;
    }
}

function hide_show_file_div(type)
{
    if(type != '' && type == 1)
    {
        $('#import_csv_div').hide();
        $('#import_excel_div').show('slow');
        $('#csv_file').val('');
    }
    else if(type != '' && type == 2)
    {
        $('#import_excel_div').hide();
        $('#import_csv_div').show('slow');
        $('#excel_file').val('');
    }
    else
    {
        $('#import_excel_div').hide('slow');
        $('#import_csv_div').hide('slow');
        $('#excel_file').val('');
        $('#csv_file').val('');
    }
}