<?php //
/*
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
                                                                        Hello <?= !empty($actdata['name']) ? $actdata['name'] . ',' : '' ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        You have requested to reset password for <?= $this->config->item('sitename') ?> account.
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        <a href="<?= $actdata['loginLink']; ?>">Click here</a> to Reset Password.
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                        Thank you,<br/>
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
