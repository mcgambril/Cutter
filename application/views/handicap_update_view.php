<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:24 PM
 */
 -->

<div class="container">
    <div class="page-header">
        <h1>Handicaps - <small>Update</small></h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="text-center col-md-12">
                <h3>Do you want to Update all Players' Handicaps?</h3>
                <br>
                <p class="col-md-4"></p>
                <a class="btn btn-default col-md-2" id="openHandicapDialog">Yes. Update Handicaps</a>
                    <!--This div sets the jquery ui dialog box for handicap update confirmation.  See assets/js/site.js for full fucntion-->
                    <div id="dialog-confirm" title="Are you sure?">Click continue to update every player's handicap.</div>
                <a class="btn btn-default col-md-2" href="<?php echo base_url("home/loadHomeLoggedIn"); ?>">Home</a>
                <p class="col-md-4"></p>
                <br><br><br>
            </div>
        </div>
    </div>
</div>