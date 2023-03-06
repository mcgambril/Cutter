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
<script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.11.3.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/site.js"); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/Site.css"); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<body>

<div class="container">
    <div class="container-fluid">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a href="<?php echo base_url("home/loadHomeLoggedIn"); ?>">Home</a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url("admin/changePassword"); ?>">Change Password</a></li>
                                <li><a href="<?php echo base_url("admin/keyTableIndex"); ?>">Update Keys Table</a></li>
                                <li><a href="<?php echo base_url("home/index"); ?>">Logout</a></li>
                            </ul>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="<?php echo base_url("score/chooseDate"); ?>">Scores</a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="<?php echo base_url("player/index"); ?>">Players</a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="<?php echo base_url("handicap/update"); ?>">Update</a>
                        </li>

                        <li class="dropdown nav-item">
                            <a href="<?php echo base_url("course/index"); ?>">Courses</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Logged in as Admin<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url("home/index"); ?>">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
            </div>
        </nav>
    </div>
</div>




