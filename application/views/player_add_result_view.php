<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/22/2015
 * Time: 3:18 PM
 */
 -->
<div class="text-center">
    <h1> <?php echo $title ?> </h1>
    <br>
    <h3> <?php echo $message1 ?> </h3>
    <h3> <?php echo $message2 ?> </h3><br><br>
</div>

<div class="text-center col-md-12">
    <p class="col-md-4"></p>
    <a class="btn btn-default col-md-2" href="<?php echo base_url("index.php/player/index"); ?>">Player - Home</a>
    <a class="btn btn-default col-md-2" href="<?php echo base_url("index.php/player/add"); ?>">Back to Add Player</a>
    <p class="col-md-4"></p>
</div>
<br><br><br>