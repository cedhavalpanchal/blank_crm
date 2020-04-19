<?php
/*
  @Description: Admin list
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
<?php
if (isset($sortby) && $sortby == 'asc') {
    $sorttypepass = 'desc';
} else {
    $sorttypepass = 'asc';
}
?>

<div class="list-pgntn-group m-t-20">
    <!--TABLE:LISTING:START-->
    <div class="table-responsive listing-table user-mngmnt-table">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="5%" class="sorting_disabled text-center" role="columnheader" rowspan="1" colspan="1" aria-label="">
                        <label class="fancy-checkbox">
                            <input type="checkbox" class="selecctall" id="selecctall">
                            <span><i></i></span>
                        </label>
                    </th>
                    <th width="20%" data-direction="desc" data-sortable="true" data-filterable="true" 
                        <?php
                            if (isset($sortfield) && $sortfield == 'name') {
                                if ($sortby == 'asc') {
                                    echo "class = 'sorting_desc'";
                                } else {
                                    echo "class = 'sorting_asc'";
                                }
                            }
                            ?> 
                            role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="descending" aria-label="Rendering engine: activate to sort column ascending">
                            <a href="javascript:void(0);" onclick="applysortfilte_contact('name', '<?php echo $sorttypepass; ?>', '<?= $path_comman ?>')">
                                <?= $this->lang->line('common_label_name') ?>
                            </a>
                    </th>
                    <th width="20%" data-direction="desc" data-sortable="true" data-filterable="true" 
                        <?php
                            if (isset($sortfield) && $sortfield == 'email') {
                                if ($sortby == 'asc') {
                                    echo "class = 'sorting_desc'";
                                } else {
                                    echo "class = 'sorting_asc'";
                                }
                            }
                            ?> 
                            role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="descending" aria-label="Rendering engine: activate to sort column ascending">
                            <a href="javascript:void(0);" onclick="applysortfilte_contact('email', '<?php echo $sorttypepass; ?>', '<?= $path_comman ?>')">
                                <?= $this->lang->line('common_label_email') ?>
                            </a>
                    </th>
                    <th width="20%" data-direction="desc" data-sortable="true" data-filterable="true" 
                        <?php
                            if (isset($sortfield) && $sortfield == 'mobile') {
                                if ($sortby == 'asc') {
                                    echo "class = 'sorting_desc'";
                                } else {
                                    echo "class = 'sorting_asc'";
                                }
                            }
                            ?> 
                            role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="descending" aria-label="Rendering engine: activate to sort column ascending">
                            <a href="javascript:void(0);" onclick="applysortfilte_contact('mobile', '<?php echo $sorttypepass; ?>', '<?= $path_comman ?>')">
                                <?= $this->lang->line('common_label_mobile') ?>
                            </a>
                    </th>
                    <th><?php echo $this->lang->line('common_label_action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($datalist) && count($datalist) > 0) { 
                    $i = !empty($this->router->uri->segments[4]) ? $this->router->uri->segments[4] + 1 : 1;
                    foreach ($datalist as $row) {
                    ?>
                    <tr>
                        <td>
                        <?php if($row['is_super'] == '0') { ?>   
                        <label class="fancy-checkbox">
                            <input type="checkbox" class="checkbox1 mycheckbox" name="check[]" value="<?php echo $row['id'] ?>">
                            <span><i></i></span>
                        </label>
                        <?php } ?>
                        </td>
                        <td><?php echo ucfirst($row['name']) ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo ($row['mobile'] != '') ? $row['mobile'] : '-' ?></td>
                        <td>
                            <div class="actn-btn-grps">
                                <?php if($row['is_super'] == '0' && $row['id'] != $this->admin_session['id']) { ?>   
                                <?php 
                                    if (!empty($row['status']) && $row['status'] == 1) { ?>
                                    <a class="icn-btn icn-text active" title="<?php echo $this->lang->line('publish_record'); ?>" href="javascript:void(0)" onclick="return status_change('0',<?= $row['id'] ?>, '<?= $path_comman ?>') ">Active</i>
                                    </a>
                                <?php } else { ?>
                                    <a class="icn-btn icn-text " title="<?php echo $this->lang->line('unpublish_record'); ?>" href="javascript:void(0)"  onclick="return status_change('1',<?= $row['id'] ?>, '<?= $path_comman ?>')" > 
                                        Deactive
                                    </a>
                                <?php }?>
                                <?php } else { ?>
                                <?php 
                                    if (!empty($row['status']) && $row['status'] == 1) { ?>
                                    <a class="icn-btn icn-text active" title="<?php echo $this->lang->line('publish_record'); ?>" href="javascript:void(0)">Active</i>
                                    </a>
                                <?php } else { ?>
                                    <a class="icn-btn icn-text " title="<?php echo $this->lang->line('unpublish_record'); ?>" href="javascript:void(0)" > 
                                        Deactive
                                    </a>
                                <?php }?>
                                <?php }?>

                                <?php if($row['is_super'] == '0' || $this->admin_session['is_super'] == '1') { ?>   
                                <a class="icn-btn icn-edit" href="<?= $this->config->item('admin_base_url') . $viewname; ?>/edit_record/<?= $row['id'] ?>" title="<?php echo $this->lang->line('edit_record'); ?>"></a>
                                <?php } ?>

                                
                                <!-- <a class="icn-btn icn-delete" title="<?php echo $this->lang->line('delete_record'); ?>"  onclick="deletepopup1('<?php echo $row['id'] ?>', '<?php echo rawurlencode(ucfirst(strtolower($row['name']))) ?>', '<?= $path_comman ?>');"> <i class="fa fa-times"></i> </a> -->
                            </div>
                        </td>
                    </tr>
                    <?php 
                    }
                }else { ?>
                    <tr>
                        <td class="text-center" colspan="4">
                            No Admin Found
                        </td>
                    </tr> 
                <?php } ?>
            </tbody>
        </table>
        <input type="hidden" id="sortfield" name="sortfield" value="<?php if (isset($sortfield)) echo $sortfield; ?>" />
        <input type="hidden" id="sortby" name="sortby" value="<?php if (isset($sortby)) echo $sortby; ?>" /></td>
        <input type="hidden" id="uri_segment" name="uri_segment" value="<?php if (isset($uri_segment)) echo $uri_segment; ?>" /></td>
        
    </div>

    <!--PAGINATION:START-->
    <nav aria-label="Page navigation" class="pagination-box">
        <div class="pagination" id="common_tb">
        <?php
            if (isset($pagination)) {
                echo $pagination;
            }
            ?>
        </div>
    </nav>
    <!--PAGINATION:CLOSE-->
</div>
