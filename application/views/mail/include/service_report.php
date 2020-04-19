<?php //
/**
    @Description: reset passwors email tamplate 
    @Author: Sanjay Rathod
    @Date: 16-10-2017
   */
?>

<tr>
    <td style="background:#ffffff;" align="left" bgcolor="#ffffff" valign="top">
        <table class="em_main_table" align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #f1f1f1;">
            <tbody>


                <tr>
                    <td style="background:#ffffff;" align="center" bgcolor="#ffffff" valign="top">
                        <table class="em_main_table" align="center" border="0" cellpadding="0" cellspacing="0" width="598">
                            <tbody><tr>

                                    <td style="line-height:0px; font-size:0px; width:10px;" align="left" valign="top" width="10"></td>
                                    <td align="center" valign="top">
                                        <table class="em_wrapper" align="center" border="0" cellpadding="0" cellspacing="0" width="540">
                                            <tbody>
                                                <tr>
                                                    <td style="line-height:0px; font-size:0px;" height="20">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top">

                                                        <table width="98%" border="0" align="left" cellpadding="8" cellspacing="2">
                                                            <tbody class="information" bgcolor="#f5f5f5 ">


                                                                <tr>
                                                                    <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        Hello Admin,
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        You have got a service request from <?= !empty($serviceData['name']) ? $serviceData['name'] : '' ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        Subject
                                                                    </td>
                                                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        <?= !empty($serviceData['subject']) ? $serviceData['subject'] : '' ?>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        Date
                                                                    </td>
                                                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        <?= !empty($serviceData['date']) ? $serviceData['date'] : '' ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        Time
                                                                    </td>
                                                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        <?= !empty($serviceData['time']) ? $serviceData['time'] : '' ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        Description
                                                                    </td>
                                                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        <?= !empty($serviceData['description']) ? $serviceData['description'] : '' ?>
                                                                    </td>
                                                                </tr>
                                                                
                                                                <?php
                                                                if(!empty($serviceData['video_url']))
                                                                {
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                            Video URL
                                                                        </td>
                                                                    </tr>
                                                                    <?php 
                                                                    foreach ($serviceData['video_url'] as $value) 
                                                                    {
                                                                        ?>
                                                                        <tr>
                                                                            <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                               <?php echo $value; ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php 
                                                                    }
                                                                }
                                                                ?>

                                                                <tr>
                                                                    <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        Thank you,</br>
                                                                        <?= $this->config->item('sitename'); ?>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td> 

                                </tr>

                            </tbody></table>  
                    </td>
                </tr>
            </tbody></table>
    </td>
</tr>
