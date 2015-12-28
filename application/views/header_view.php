<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/27/2015
 * Time: 9:31 PM
 */
 -->

<html>

<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />

<head>
    <title>Cutter</title>
</head>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="icon" href="<?php echo base_url("assets/images/golfball2.jpg");?>" />
<!--Just need to insert a good icon image above instead of the test icon-->
<script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.11.3.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/Site.css"); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat:  'yy-mm-dd',
            showAnim: 'slideDown'
        });
    });
</script>

<!--<style type="text/css">
    body {
        padding-top: 60px;
    }
</style>-->

<?php
    date_default_timezone_set('America/Mexico_City');
?>

<body>

<div class="container">
    <div class="container-fluid">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url("index.php/home/loadHomeLoggedIn"); ?>">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/home/index"); ?>">Logout</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Score<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/score/index"); ?>">Score - Home</a></li>
                            <li><a href="<?php echo base_url("index.php/score/postDate"); ?>">Score - Post</a></li>
                            <li><a href="<?php echo base_url("index.php/score/chooseEditDate"); ?>">Score - Batch Edit By Date</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Player<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/player/index"); ?>">Player - Home</a></li>
                            <li><a href="<?php echo base_url("index.php/player/add"); ?>">Player - Add</a></li>
                            <li><a href="<?php echo base_url("index.php/header/loadPlayerDeleteView"); ?>">Player - Batch Delete</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Handicap<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/handicap/index"); ?>">Handicap - Update</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Course<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/course/index"); ?>">Course - Home</a></li>
                            <li><a href="<?php echo base_url("index.php/course/add"); ?>">Course - Add</a></li>
                            <li><a href="<?php echo base_url("index.php/header/loadCourseEditView"); ?>">Course - Set Home Course</a></li>
                            <li><a href="<?php echo base_url("index.php/header/loadCourseDeleteView"); ?>">Course - Batch Delete</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Logged in as Admin<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/home/index"); ?>">Logout</a></li>
                        </ul>
                    </li>
                </ul>
        </div>
    </nav>
    </div>
</div>




