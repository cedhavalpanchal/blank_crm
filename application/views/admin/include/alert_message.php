<div class="text-center" id="div_msg">
    <?php
        if (null !== ($this->session->flashdata('message_session')) && false !== $this->session->flashdata('message_session')) {
            $flash = $this->session->flashdata('message_session');
            if ($flash['status'] === 'failed') {
                ?>
                <div class="alert alert-danger">
                    <a href="javascript:void(0)" class="close close-message" aria-label="close" title="Close">&times;</a>
                <?php echo $flash['message']; ?>
                </div>
            <?php } else { ?>
                <div class="alert alert-success">
                    <a href="javascript:void(0)" class="close close-message" aria-label="close" title="Close">&times;</a>  <?php echo $flash['message']; ?>
                </div>
            <?php
        }
    }
    ?>
</div>
