<?php
/*
  @Description: Commission transaction list
  @Author: Mit Makwana
  @Date: 21-05-2018
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
    
    <!--CARD BOX: Start-->
    <?php
    if (!empty($datalist) && count($datalist) > 0) {
        
        foreach ($datalist as $row) {
            
            ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="card-block ld-crd-mn-bx pdng-0">
                        <div class="ld-ttl-bar">
                            <figure class="pl-pcs">
                                <span>
                                    <?php 
                                        if(!empty($row['profile_pic']) && file_exists($this->config->item('admin_pic_thumb_path').$row['profile_pic']))
                                        {
                                            ?>
                                                <img src="<?=$this->config->item('admin_pic_thumb_url').$row['profile_pic']; ?>" alt="">
                                            <?php
                                        }
                                        else
                                        {
                                            echo strtoupper((!empty($row['f_char'])?$row['f_char']:'').(!empty($row['l_char'])?$row['l_char']:''));
                                        }
                                    ?>
                                </span>                               
                            </figure>
                            <div class="pl-pcs-nm">
                               <?= ucwords(strtolower($row['lead_added_by']));?>
                            </div>
                            <div class="ld-cnt">
                               <h3 class="orange-clr"><?= ucwords(strtolower($row['total_lead']));?></h3>
                               <span>Leads</span>
                            </div>
                        </div>
                        <div class="table-responsive cd-list-table">
                            <table class="table">
                                <?php 
                                    $leadNameExp    = explode('|', $row['lead_name']);
                                    $leadSourceExp  = explode('|', $row['lead_source']);
                                    $leadIdExp      = explode('|', $row['lead_id']);

                                    for ($i=0; $i <count($leadNameExp) ; $i++) { 
                                        if($i < 5)
                                        {
                                        ?>
                                            <tr>
                                                <th><?=  !empty($leadNameExp[$i])?ucwords(strtolower($leadNameExp[$i])):''; ?></th>
                                                <td><?=  !empty($leadSourceExp[$i])?ucwords(strtolower($leadSourceExp[$i])):''; ?></td>
                                    
                                                <td><a class="icn-view" href="<?= $this->config->item('admin_base_url')?>lead_management/view_record/<?= $leadIdExp[$i] ?>"></a></td>
                                            </tr>
                                        <?php
                                        }
                                    }
                                ?>
                            </table>
                        </div>
                        <?php 
                            if(!empty($row['total_lead']) && $row['total_lead'] >= 5)
                            {
                        ?>
                            <div class="view-more">
                                <a href="javascript:void(0);">View all leads </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php 

            
        }
    }
    else
    {
        ?>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="card-block ld-crd-mn-bx pdng-0">
                No Records Found
            </div>
        </div>
    <?php
    }
    ?>
    <!--CARD BOX: Close-->