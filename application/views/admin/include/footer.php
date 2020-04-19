<!-- Js file -->
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.blockUI.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.confirm.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="<?php echo $this->config->item('js_path') ?>bootstrap.js"></script>
<script src="<?php echo $this->config->item('js_path') ?>dcalendar.picker.js"></script>
<script src="<?php echo $this->config->item('asset_path') ?>themes/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('asset_path') ?>themes/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('asset_path') ?>themes/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>common.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>custom_function.js"></script>
<script type="text/javascript">
            
    var Logout_url = '<?= $this->config->item('admin_base_url').'logout'; ?>';
    function logout(){

        $.confirm({
            'title': 'ALERT','message': " <strong> <?= $this->lang->line('logout_confirm'); ?>",'buttons': {'Yes': {'class': '',
            'action': function(){
                location.href = Logout_url;
            }},'No' : {'class'  : 'special'}}}); 

    }
    $.blockUI({message: '<?= '<img src="' . base_url('images') . '/ajaxloader.gif" border="0" align="absmiddle"/>' ?> Please Wait...'});
    $(document).ready(function() {
        $.unblockUI();
    });

</script>
<?php
//Javascript file included page wise
(isset($foot_part_js) && !empty($foot_part_js)) ? print '<script type="text/javascript" src="' . $this->config->item('js_path') . 'admin/' . $foot_part_js . '.js"></script>' : '';
?>
</body>

</html>
