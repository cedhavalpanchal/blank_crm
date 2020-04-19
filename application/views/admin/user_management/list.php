<?php
/*
  @Description: Admin List
  @Author: Dhaval Panchal
  @Date: 18-07-18
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
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
          <input type="hidden" id="path_comman" name="path_comman" value="<?= $path_comman;?>" /></td>
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
        <?= $this->load->view('admin/include/alert_message') ?>
        <div id="common_div">
            <?= $this->load->view('admin/' . $viewname . '/ajax_list', '', true) ?>
        </div>       
      </div>
  </div>
</div>
