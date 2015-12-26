<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/25/2015
 * Time: 11:14 PM
 */
 -->

<div class="text-center">
    <h1> <?php echo $title ?> </h1>
    <br>
    <h3> <?php echo $message ?> </h3><br><br>
</div>

<div class="text-center">
    <a class="btn btn-default" href="<?php echo base_url("index.php/course/index"); ?>">Course - Home</a>
    <a class="btn btn-default" href="<?php echo base_url("index.php/course/add"); ?>">Back to Add Course</a>
</div>
<br><br><br>