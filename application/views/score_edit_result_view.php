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
    <?php
        if ($errors == TRUE) {
            echo'<h1>' . $errorTitle . '</h1>
            <br>
            <h3>' . $errorMessage . '</h3>
            <br><br>';
        }
    ?>
</div>

<div class="row">
    <div class="text-center col-md-12">
        <div class="col-md-5"></div>
        <a class="btn btn-default col-md-2" href="<?php echo base_url("index.php/score/chooseDate"); ?>">Scores Home</a>
        <div class="col-md-5"></div>
    </div>
</div>
<br><br><br>