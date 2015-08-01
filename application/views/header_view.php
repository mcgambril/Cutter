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

<script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.11.3.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>

<style type="text/css">
    body {
        padding-top: 60px;
    }
</style>

<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url("index.php/header/loadHomeView"); ?>">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/header/loadAdminView"); ?>">Login</a></li>
                            <li><a href="<?php echo base_url("index.php/header/loadHomeView"); ?>">Logout</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Score<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/header/loadScoreHomeView"); ?>">Score - Home</a></li>
                            <li><a href="<?php echo base_url("index.php/header/loadScorePostView"); ?>">Score - Post</a></li>
                            <li><a href="<?php echo base_url("index.php/header/loadScoreEditView"); ?>">Score - Edit</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Player<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/header/loadPlayerHomeView"); ?>">Player - Home</a></li>
                            <li><a href="<?php echo base_url("index.php/header/loadPlayerAddView"); ?>">Player - Add</a></li>
                            <li><a href="<?php echo base_url("index.php/header/loadPlayerEditView"); ?>">Player - Edit</a></li>
                            <li><a href="<?php echo base_url("index.php/header/loadPlayerDeleteView"); ?>">Player - Delete</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Handicap<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/header/loadHandicapUpdateView"); ?>">Handicap - Update</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Course<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("index.php/header/loadCourseHomeView"); ?>">Course - Home</a></li>
                            <li><a href="<?php echo base_url("index.php/header/loadCourseAddView"); ?>">Course - Add</a></li>
                            <li><a href="<?php echo base_url("index.php/header/loadCourseEditView"); ?>">Course - Edit</a></li>
                            <li><a href="<?php echo base_url("index.php/header/loadCourseDeleteView"); ?>">Course - Delete</a></li>
                        </ul>
                    </li>
                </ul>
        </div>
    </nav>



