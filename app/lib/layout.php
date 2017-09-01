<?php

function renderHeader()
{
    ?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plan-On</title>
    <link rel='stylesheet' id='normalize-css'  href='<?php echo __SITE_URL; ?>/style/normalize.css' type='text/css' media='all' />
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' id='bootstrap-css'  href='<?php echo __SITE_URL; ?>/style/bootstrap.min.css' type='text/css' media='all' />
    
    <script type="text/javascript" src="<?php echo __SITE_URL; ?>/scripts/jquery.js"></script>
    <script type="text/javascript" src="<?php echo __SITE_URL; ?>/scripts/menu.js"></script>
    <script type="text/javascript" src="<?php echo __SITE_URL; ?>/scripts/bootstrap.min.js"></script>

    <style>
        body
        {
            background-image: url('<?php echo __SITE_URL; ?>/style/bg.png');
            background-repeat: repeat-x;
            background-attachment: fixed;
            background-position: bottom;
        }
        .panel {
            border-radius: 0px;
        }
        
        .panel-body{
                padding: 15px;
        }

        .panel-footer{
                padding: 5px;
        }

        .input-block-level {
            width: 75%;
            min-height: 28px;
            box-sizing: border-box;
        }

        .container{
            width: 100%;
        }
    </style>

</head>
<?php
}

function renderFooter()
{
?>
<?php
}