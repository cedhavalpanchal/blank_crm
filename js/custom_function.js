/*
 @Description: Comman JS Functions
 @Author: Mit Makwana
 @Date: 24-11-2016
 */

var all_delete_action_msg      = 'Record(s) deleted successfully';
var all_published_action_msg   = 'Record(s) activated successfully';
var all_unpublished_action_msg = 'Record(s) inactivated successfully';
var all_read_action_msg   = 'Record(s) read successfully';
var confirm_active_msg         = 'Are you sure you want to inactive record';
var confirm_inactive_msg       = 'Are you sure you want to active record';
var confirm_read_msg           = 'Are you sure you want to read record';
var confirm_sigle_delete_msg   = 'Are you sure you want to delete record(s)? If you choose yes then it will delete all associated records also.';
var confirm_multi_delete_msg   = 'Are you sure you want to delete record(s)? If you choose yes then it will delete all associated records also.';
var confirm_delete_if_booking_started = "Booking is started for this user.";
var confirm_delete_if_booking_started_multiple = "Booking is started for few users.";
/*
 @Description: Function For Searching Data
 @Author: Mit Makwana
 @Input: String 
 @Output: Data list
 @Date: 24-11-2016
 */
function search_data(allflag, view_name, popupcontactlist)
{
    var uri_segment = $("#uri_segment").val();
    var type = $("#type").val();
    
    $.ajax({
        type: "POST",
        url: view_name + "" + uri_segment,
        data: {
            result_type: 'ajax', searchreport: $("#searchreport").val(), perpage: $("#perpage").val(), searchtext: $("#searchtext").val(), sortfield: $("#sortfield").val(), sortby: $("#sortby").val(), type:type, searchcategory: $("#searchcategory").val(), searchobjtype: $("#searchobjtype").val(), searchusertype: $("#searchusertype").val(), searchuserstatus: $("#searchuserstatus").val(),searchobjstatus: $("#searchobjstatus").val(), from_date: $("#from_date").val(), to_date: $("#to_date").val(), category: $("#category").val(), admin_type: $("#admin_type").val(), lead_source: $("#lead_source").val(), slider_min_val: $("#slider_min_val").val(), slider_max_val: $("#slider_max_val").val(), allflag: allflag
        },
        beforeSend: function() {
            $('#common_div').block({message: 'Loading...'});
        },
        success: function(html) {
            $("#common_div").html(html);
            try
            {
                for(i=0;i<popupcontactlist.length;i++)
                {
                    $('.mycheckbox:checkbox[value='+popupcontactlist[i]+']').attr('checked',true)
                }
            }
            catch(e){}
            $('#common_div').unblock();
        }
    });
    return false;
}
/*
 @Description: Function For Confirm Box
 @Author: Mit Makwana
 @Input: 
 @Output: 
 @Date: 24-11-2016
 */

function deletepopup1(id, name, viewname, is_booking = '')
{

    var boxes = $('input[name="check[]"]:checked');
    var conf_msg = '';
    if (boxes.length == '0' && id == '0')
    {
        $.confirm({'title': 'Alert', 'message': " <strong> Please select record(s) to delete. " + "<strong></strong>", 'buttons': {'ok': {'class': 'btn_center alert_ok'}}});
        $('#selecctall').focus();
        return false;

    }
    if (id == '0')
    {
        var msg = confirm_multi_delete_msg;
    }
    else
    {
        var msg = confirm_sigle_delete_msg;
        if(is_booking == '1')
        {
            conf_msg = confirm_delete_if_booking_started;
        }
    }
    $.confirm({'title': 'CONFIRM', 'message': " <strong style='color:red;font-size:18px;'>"+conf_msg+"</strong><strong> " + msg + " " + "</strong>", 'buttons': {'Yes': {'class': '',
                'action': function() {
                    delete_all(id, viewname);
                }}, 'No': {'class': 'special'}}});
}
/*
 @Description: Function For After Confirm Then Delele data
 @Author: Mit Makwana
 @Input: 
 @Output: 
 @Date: 24-11-2016
 */
function delete_all(id, viewname)
{
    var div_msg = "<label class='error-list-color'>" + all_delete_action_msg + "</label>";
    var myarray = new Array;
    var i = 0;
    var boxes = $('input[name="check[]"]:checked');

    if (id != '0')
    {
        var single_remove_id = id;
    }
    else
    {
        $(boxes).each(function() {
            myarray[i] = this.value;
            i++;
        });
    }
    $.ajax({
        type: "POST",
        url: viewname + "ajax_delete_all",
        dataType: 'json',
        async: false,
        data: {'myarray': myarray, 'single_remove_id': id},
        success: function(data) {
            $.ajax({
                type: "POST",
                url: viewname + '/' + data,
                data: {
                    result_type: 'ajax', searchreport: $("#searchreport").val(), perpage: $("#perpage").val(), searchtext: $("#searchtext").val(), sortfield: $("#sortfield").val(), sortby: $("#sortby").val(), allflag: ''
                },
                beforeSend: function() {
                    $('#common_div').block({message: 'Loading...'});
                },
                success: function(html) {
                    $("#common_div").html(html);
                    $('#common_div').unblock();
                    
                    $("#div_msg").css('display', 'block');
                    var message = '';
                     message+='<div class="alert alert-success">';
                     message+='<a href="javascript:void(0)" class="close close-message" aria-label="close" title="Close">&times;</a>';
                     message+=''+div_msg+'';
                     message+='</div>';
                    $("#div_msg").html(message);
                    setTimeout(function() {
                        $('#div_msg').hide('slow');
                    }, 5000);
                    
                }
            });
            return false;
        }
    });
}

/*
 @Description: Function For Multiple Delete,published and unpublished
 @Author: Mit Makwana
 @Input : Id Array
 @Output: 
 @Date: 24-11-2016
 */
function delete_all_multipal(val, viewname, popupcontactlist)
{
    var bookedarray = new Array;
    var j = 0;
    var conf_msg = '';
    var boxes = $('input[name="check[]"]:checked');
    $(boxes).each(function() {
        //console.log($(this).data('booked'));
        if($(this).data('booked') == 1)
        {
            bookedarray[j] = this.value;
            j++;
        }
    });

    if(j > 0)
    {
        conf_msg = confirm_delete_if_booking_started_multiple;
    }

   var status = '';
    if (val == 'delete')
    {
        var msg = '<strong style="color:red;font-size:18px;">'+conf_msg+'</strong> Are you sure you want to ' + val + ' record(s)? If you choose yes then it will delete all associated records also. ';
    } else if (val == 'inactivate')
    {
        var msg = '<strong style="color:red;font-size:18px;">'+conf_msg+'</strong> Are you sure you want to ' + val + ' record(s)?';
    } else {
        var msg = 'Are you sure you want to ' + val + ' record(s)?';
    }
    var boxes = $('input[name="check[]"]:checked');
    if (boxes.length == '0')
    {
        $.confirm({'title': 'Alert', 'message': " <strong> Please select record(s) to " + val + ". " + "<strong></strong>", 'buttons': {'ok': {'class': 'btn_center alert_ok'}}});
        $('#selecctall').focus();
        return false;

    }
    $.confirm({'title': 'CONFIRM', 'message': " <strong> " + msg + " " + "<strong></strong>", 'buttons': {'Yes': {'class': '',
                'action': function() {
                    var div_msg = '';
                    var myarray = new Array;
                    var i = 0;
                    var boxes = $('input[name="check[]"]:checked');
                    $(boxes).each(function() {
                        myarray[i] = this.value;
                        i++;
                    });
                    if (val == 'delete')
                    {
                        var url = viewname + "ajax_delete_all";
                        div_msg = "<label class='error-list-color'>" + all_delete_action_msg + "</label>";
                    }
                    if (val == 'active')
                    {
                        var url = viewname + "ajax_status_all";
                        div_msg = "<label class='error-list-color'>" + all_published_action_msg + "</label>";
                        status = '1';
                    }
                    if (val == 'inactive')
                    {
                        var url = viewname + "ajax_status_all";
                        div_msg = "<label class='error-list-color'>" + all_unpublished_action_msg + "</label>";
                        status = '0';
                    }
                    if (val == 'read')
                    {
                        var url = viewname + "ajax_status_all";
                        div_msg = "<label class='error-list-color'>" + all_read_action_msg + "</label>";
                        status = '1';
                        div_msg = "<label class='error-list-color'>" + all_read_action_msg + "</label>";
                    }

                    $.ajax({
                        type: "POST",
                        url: url,
                        dataType: 'json',
                        async: false,
                        data: {'myarray': myarray, status: status},
                        success: function(data) {
                            $.ajax({
                                type: "POST",
                                url: viewname + "/" + data,
                                data: {
                                    result_type: 'ajax', searchreport: $("#searchreport").val(), perpage: $("#perpage").val(), searchtext: $("#searchtext").val(), sortfield: $("#sortfield").val(), sortby: $("#sortby").val(), allflag: ''
                                },
                                beforeSend: function() {
                                    $('#common_div').block({message: 'Loading...'});
                                },
                                success: function(html) {

                                    $("#cnt_selected").text("0 Record(s) Selected");
                                    arraydatacount = 0;
                                    popupcontactlist = Array();
                                    $('#delete_all').val('');
                                    $("#common_div").html(html);
                                    $('#common_div').unblock();
                                    $("#div_msg").css('display', 'block');
                                    
                                    var message = '';
                                    message+='<div class="alert alert-success">';
                                    message+='<a href="javascript:void(0)" class="close close-message" aria-label="close" title="Close">&times;</a>';
                                    message+=''+div_msg+'';
                                    message+='</div>';
                                   $("#div_msg").html(message);
                                   setTimeout(function() {
                                        $('#div_msg').hide('slow');
                                    }, 5000);

                                }
                            });
                            return false;
                        }
                    });
                }}, 'No': {'class': 'special'}}});
}

/*
 @Description: Function For Searching Reset
 @Author: Mit Makwana
 @Input : 
 @Output: 
 @Date: 24-11-2016
 */
function clearfilter_data(viewname, popupcontactlist)
{
    $("#searchtext").val("");
    $("#type").val("");
    $("#searchcategory").val("");
    $("#searchobjtype").val("");
    $("#searchobjstatus").val("");
    $("#searchusertype").val("");
    $("#searchuserstatus").val("");
    $("#from_date").val("");
    $("#to_date").val("");
    $("#category").val("");
    $("#admin_type").val("");
    $("#lead_source").val("");
    $('#slider_min_val').val("");
    $('#slider_max_val').val("");
    //$('#ex2').slider('refresh');
    applysortfilte_contact('', '', viewname);

}
/*
 @Description: Function For Per Page Record
 @Author: Mit Makwana
 @Input : 
 @Output: 
 @Date: 24-11-2016
 */
function changepages(viewname, popupcontactlist)
{

    search_data('', viewname, popupcontactlist);
}
function searchcategory(viewname, popupcontactlist)
{

    search_data('', viewname, popupcontactlist);
}
function searchobjtype(viewname)
{
    search_data('', viewname);
}
function searchusertype(viewname)
{
    search_data('', viewname);
}
function searchleadsource(viewname)
{
    search_data('', viewname);
}
function searchuserstatus(viewname, popupcontactlist)
{
    search_data('', viewname, popupcontactlist);
}
function searchobjstatus(viewname)
{
    search_data('', viewname);
}
function changecategory(viewname)
{
    search_data('', viewname);
}

/*
 @Description: Function For Sorting Field
 @Author: Mit Makwana
 @Input : 
 @Output: 
 @Date: 24-11-2016
 */
function applysortfilte_contact(sortfilter, sorttype, viewname)
{
    $("#sortfield").val(sortfilter);
    $("#sortby").val(sorttype);
    search_data('changesorting', viewname, popupcontactlist);
}


function status_change(status,id,viewname,is_booking = '')
{
            var conf_msg = '';
            var path= viewname+"status_update/"+id

            if(status == 0)
            {   
                if(is_booking == '1')
                {
                    conf_msg = confirm_delete_if_booking_started;
                }
                var msg = confirm_active_msg;
                var div_msg = "<label class='error-list-color'>" + all_unpublished_action_msg + "</label>";
            }else
            {
                var msg = confirm_inactive_msg;
                var div_msg = "<label class='error-list-color'>" + all_published_action_msg + "</label>";
            }
            //var div_msg = "<label class='error-list-color'>" + all_published_action_msg + "</label>";

            $.confirm({'title': 'CONFIRM','message': "<strong style='color:red;font-size:18px;'>" + conf_msg + " </strong><strong> "+msg+""+"?",'buttons': {'Yes': {'class': '',
       'action': function(){
            $.ajax({
                type: "POST",
                url: path,
                dataType: 'json',
                data : {'status' :status},
                beforeSend: function() {
                 $('#common_div').block({ message: 'Loading...' }); 
                },
                success: function(result){
                    $('#common_div').unblock(); 
                    $.ajax({
                        type: "POST",
                        url: viewname+result,
                        data: {
                        result_type:'ajax',searchreport:$("#searchreport").val(),perpage:$("#perpage").val(),searchtext:$("#searchtext").val(),sortfield:$("#sortfield").val(),sortby:$("#sortby").val()
                        },
                        beforeSend: function() {
                            $('#common_div').block({ message: 'Loading...' }); 
                        },
                        success: function(html){
                            $("#common_div").html(html);
                            $("#cnt_selected").text("0 Record(s) Selected");
                            arraydatacount = 0;
                            popupcontactlist = Array();
                            $('#common_div').unblock(); 
                            $("#div_msg").css('display','block'); 
                            
                            var message = '';
                            message+='<div class="alert alert-success">';
                            message+='<a href="javascript:void(0)" class="close close-message" aria-label="close" title="Close">&times;</a>';
                            message+=''+div_msg+'';
                            message+='</div>';
                           $("#div_msg").html(message);
                           setTimeout(function() {
                                $('#div_msg').hide('slow');
                            }, 5000);
                        }
                    });
                    return false;
                },error: function(jqXHR, textStatus, errorThrown) {
                    $.unblockUI();
                }
            });
    }},'No'	: {'class'	: 'special'}}});
      }    

