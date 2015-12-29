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

<div class="text-center">
    <a class="btn btn-default" href="<?php echo base_url("index.php/course/index"); ?>">Course - Home</a>
    <a class="btn btn-default" href="<?php echo base_url("index.php/course/setHomeCourse"); ?>">Back to Set Home Course</a>
</div>
<br><br><br>