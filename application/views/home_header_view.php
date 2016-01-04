<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:50 PM
 */
 -->

<html>

<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />

<head>
    <title>Cutter</title>
</head>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="icon" href="<?php echo base_url("assets/images/golfball2.jpg");?>" />
<script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.11.3.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/site.js"); ?>"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/Site.css"); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat:  'yy-mm-dd',
            showAnim: 'slideDown'
        });
    });
</script>-->

<?php
/*    date_default_timezone_set('America/Mexico_City');
*/?>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url("index.php/home/index"); ?>">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url("index.php/admin/index"); ?>">Login</a></li>
                    </ul>
                </li>
            </ul>
        </div>
</nav>