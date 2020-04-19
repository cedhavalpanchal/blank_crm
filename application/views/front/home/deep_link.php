<!doctype html>

<html>

<head>

    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?=$this->config->item('js_path')?>browser-deeplink.js" type="text/javascript"></script>

    <script type="text/javascript">

        function deep_link(uri) {

            deeplink.setup({

                iOS: {
                    appId: "1247814420",
                    appName: "MFT"
                }
            });

            deeplink.open(uri);
        }

    </script>

</head>

<body>
<?php $url = "Mifty://userSearch/userid=".end($this->uri->segments); ?>
    <div class="container">

        <div class="kuloni-section-welcome">

            <h1>Welcome to <?php echo $this->config->item('project_name') ?></h1>

            <a href="javascript:;" data-uri="Mifty://" onclick="deep_link(this.dataset.uri)">iOS</a>
        </div>
    </div>
</body>

</html>

