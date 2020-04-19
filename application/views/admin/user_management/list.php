<?php
/*
  @Description: Admin List
  @Author: Dhaval Panchal
  @Date: 18-07-18
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script language="javascript">
    $.blockUI({message: '<?= '<img src="' . base_url('images') . '/ajaxloader.gif" border="0" align="absmiddle"/>' ?> Please Wait...'});
    $(document).ready(function() {
        $.unblockUI();
    });
</script>
<?php
$viewname = $this->router->uri->segments[2];
$path_comman = $this->config->item('admin_base_url') . $viewname . '/';
?>

<!-- sidebar start -->
<div class="main-container">
  <div class="page-container">
      <div class="titlebar">
          <h1 class="orange-clr"><?=$this->page_title?></h1>
          <a href="<?= $path_comman.'add_record'; ?>" class="btn btn-primary actn-btn pull-right">Add <?= ($this->lang->line('user_short')) ?></a>
      </div>

      <div class="card-block">
        <!--TOP SEARCHBAR:START--> 
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="select-style tdy-tsk-slct actn-slct">
              <select id="delete_all">
                <option value="">Select</option>
                <!-- <option value="<?php echo $this->lang->line('delete_short'); ?>"><?php echo $this->lang->line('delete'); ?></option> -->
                <option value="<?php echo $this->lang->line('active_short'); ?>"><?php echo $this->lang->line('active'); ?></option>
                <option value="<?php echo $this->lang->line('inactive_short'); ?>"><?php echo $this->lang->line('inactive'); ?></option>
              </select>
            </div>
            <button id="allcheck" type="button" class="btn btn-primary actn-btn">Submit</button>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="rgt-srh-group">
              <div class="mn-srh-bx">
                <input class="form-field" type="text" name="searchtext" id="searchtext" aria-controls="DataTables_Table_0" placeholder="<?php echo $this->lang->line('search_here'); ?>" title="<?php echo $this->lang->line('search_here'); ?>" value="<?= !empty($searchtext) ? $searchtext : '' ?>">
                <button onclick="search_data('changesearch', '<?= $path_comman ?>', popupcontactlist)" class="srh-btn"><span></span></button>
              </div>
              <button type="reset" onclick="clearfilter_data('<?= $path_comman ?>')" class="btn btn-reset actn-btn">Reset</button>
              
              <div class="ttl-ld-bx">
                  Total Users: <span><?=!empty($datalist)? count($datalist):'0'?></span>
              </div>
              <?php $per_page = per_page_array();?>
              <div class="select-style pgntn-slct-bx">
                  <select class="selec" name="DataTables_Table_0_length" size="1" aria-controls="DataTables_Table_0" onchange="changepages('<?= $path_comman ?>',popupcontactlist);" id="perpage">
                      <?php foreach ($per_page as $key => $value) 
                      {
                          ?>
                          <option <?php if (!empty($perpage) && $perpage == $value) { echo 'selected="selected"'; } ?> value="<?=$key?>"><?=$value?></option>
                          <?php
                      }
                      ?>
                  </select>
              </div>
              
            </div>
          </div>
        </div>
         <!--TOP SEARCHBAR:CLOSE-->
         <div class="row">
            <div class="col-sm-12 text-center">
                <div id="div_msg">
                    <?php
                    if (null !== ($this->session->flashdata('response')) && false !== $this->session->flashdata('response')) {
                        $flash = $this->session->flashdata('response');
                        if ($flash['status'] === 'failed') {
                            ?>
                            <div class="alert alert-danger">
                                <a href="javascript:void(0)" class="close close-message" aria-label="close" title="Close">&times;</a>
                                <?php echo $flash['message']; ?>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-success">
                                <a href="javascript:void(0)" class="close close-message" aria-label="close" title="Close">&times;</a>
                                <?php echo $flash['message']; ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div id="common_div">
            <?= $this->load->view('admin/' . $viewname . '/ajax_list', '', true) ?>
        </div>       
      </div>
  </div>
</div>
<script>
    var arraydatacount = 0;
    var popupcontactlist = Array();

    $('#searchtext').keyup(function(event)
    {
        if (event.keyCode == 13) {
            search_data('changesearch', '<?= $path_comman ?>', popupcontactlist);
        }
    });

    $('body').on('click', '#common_tb a', function(e) {
        $.ajax({
            type: "POST",
            url: $(this).attr('href'),
            data: {
                result_type: 'ajax', searchreport: $("#searchreport").val(), perpage: $("#perpage").val(), searchtext: $("#searchtext").val(), sortfield: $("#sortfield").val(), sortby: $("#sortby").val()
            },
            beforeSend: function() {
                $.blockUI({message: '<?= '<img src="' . base_url('images') . '/ajaxloader.gif" border="0" align="absmiddle"/>' ?> Please Wait...'});
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
                $.unblockUI();
            }
        });
        return false;

    });

    $('body').on('click','#selecctall',function(e)
    {
        if(this.checked) { // check select status
            $('.mycheckbox').each(function() { //loop through each checkbox

                this.checked = true;  //select all checkboxes with class "mycheckbox" 

                var arrayindex = jQuery.inArray( parseInt(this.value), popupcontactlist );

                if(arrayindex == -1)
                {
                    popupcontactlist[arraydatacount++] = parseInt(this.value);
                }             
            });
        } else {
            $('.mycheckbox').each(function() { //loop through each checkbox

                this.checked = false; //deselect all checkboxes with class "mycheckbox"

                var arrayindex = jQuery.inArray( parseInt(this.value), popupcontactlist );

                if(arrayindex >= 0)
                {
                    popupcontactlist.splice( arrayindex, 1 );
                    arraydatacount--;
                }

            });        
        }
        $("#cnt_selected").text(popupcontactlist.length + " Record(s) Selected");
          
    });

    $('#allcheck').click(function() {
        var val = $('#delete_all').val();
        if (val != '')
        {
            delete_all_multipal(val, '<?= $path_comman ?>', popupcontactlist);

            arraydatacount = 0;
            popupcontactlist = Array();
        }
        else
        {
            $.confirm({'title': 'Alert', 'message': "<strong><?= $this->lang->line('select_oparation')?></strong>", 'buttons': {'ok': {'class': 'btn_center'}}});
        }
    });

    $('body').on('click','.mycheckbox',function(e){
    
        if($('.mycheckbox:checkbox[value='+parseInt(this.value)+']:checked').length)
        {   
          var arrayindex = jQuery.inArray( parseInt(this.value), popupcontactlist );
          if(arrayindex == -1)
          {       
            popupcontactlist[arraydatacount++] = parseInt(this.value);
          }

            if ($('.mycheckbox:checked').length == $('.mycheckbox').length) {
                $('#selecctall').prop('checked', true); // Checks it   
            }
        }
        else
        {
          var arrayindex = jQuery.inArray( parseInt(this.value), popupcontactlist );
          if(arrayindex >= 0)
          {
            popupcontactlist.splice( arrayindex, 1 );
            $('#selecctall').prop('checked', false); // Checks it
            arraydatacount--;
          }
        }
        $("#cnt_selected").text(popupcontactlist.length + " Record(s) Selected");

    });

    function remove_selection() {
      var cnt = popupcontactlist.length;
      for(i=0;i<popupcontactlist.length;i++)
      {
        $('.mycheckbox:checkbox[value='+popupcontactlist[i]+']').attr('checked',false);
      }
        $('#selecctall').attr('checked',false);
        popupcontactlist = Array();
        $("#cnt_selected").text("0 Record(s) Selected");
        arraydatacount = 0;

    }

</script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>custom_function.js"></script>