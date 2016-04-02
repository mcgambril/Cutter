<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/29/2015
 * Time: 3:12 AM
 */
 -->

<div class="text-center">
    <h1> <?php echo $title ?> </h1>
    <br>
    <h3> <?php echo $message1 ?> </h3>
    <h3> <?php echo $message2 ?> </h3><br><br>
</div>

<div class="text-center col-md-12">
    <p class="col-md-4 col-xs-1"></p>
    <a class="btn btn-default col-md-2 col-xs-5" href="<?php echo base_url("course/index"); ?>">Course - Home</a>
    <a class="btn btn-default col-md-2 col-xs-5" href="<?php echo base_url("course/setHomeCourse"); ?>">Back</a>
    <p class="col-md-4 col-xs-1"></p>
</div>
<br><br><br>