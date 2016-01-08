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
            <div class="text-center">
                <h3>Do you want to Update all Players' Handicaps?</h3>
                <br>
                <p class="col-md-4"></p>
                <!--<a class="btn btn-default col-md-2" onclick="return confirmSubmit(this.form)" href="<?php /*echo base_url("index.php/handicap/submitUpdate"); */?>">Yes. Update Handicaps</a>-->
                <?php
                    /*$onclick = array('onclick' => "return confirm('Are you sure?')");
                    $submitUpdateLink = base_url("index.php/handicap/submitUpdate");*/
                    //anchor($submitUpdateLink, 'Yes. Update Handicaps', $onclick);
                ?>
                <!--<a class="btn btn-default col-md-2" href="<?php /*echo base_url("index.php/handicap/submitUpdate"); */?>" onclick="return confirmHandicapUpdate();">Yes. Update Handicaps</a>-->
                <a class="btn btn-default col-md-2" id="openHandicapDialog">Yes. Update Handicaps</a>
                <div id="dialog-confirm" title="Are you sure?">Click continue to update every player's handicap.</div>
                <!--<a class="btn btn-default col-md-2" ><?php /*echo anchor($submitUpdateLink, 'Yes. Update Handicaps', $onclick); */?></a>-->
                <a class="btn btn-default col-md-2" href="<?php echo base_url("index.php/"); ?>">Home</a>
                <p class="col-md-4"></p>
                <br><br><br>
            </div>
        </div>
    </div>
</div>