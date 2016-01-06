<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/20/2015
 * Time: 11:19 PM
 */
 -->

<div class="text-center">
    <?php
    if($deleteResult !== 'NULL') {
        echo '<h1>' . $deleteResult . '</h1>';
        echo '<br>';
        echo '<h3>' . $deleteMessage . '</h3>';
        echo '<br><br>';
    }
    ?>
    <h1> <?php echo $title ?> </h1>
    <br>
    <h3> <?php echo $message ?> </h3>
    <br><br>
</div>

<div class="text-center">
    <a class="btn btn-default" href="<?php echo base_url("index.php/score/chooseDate"); ?>">Scores Home</a>
</div>
<br><br><br>