<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:24 PM
 */
 -->
<div class="text-center">
<h1>Success!</h1>
<br>
<h2>The following scores were successfully entered into the database:</h2>
</div>
<br>
<?php
/*    print_r(array($enteredScoreInfo));
    print_r(array($playerNames));
    foreach ($enteredScoreInfo as $row) {
        echo $row->scoreCourseID;
        echo $row->scoreScore;
        echo $row->scoreDate;
        echo $row->scoreTime;
        echo $row->scoreDifferential;
    }
    foreach ($playerNames as $row) {
        echo $row->playerName;
    }
*/?>
<div class="text-center">
<a class="btn btn-default" href="<?php echo base_url("index.php/score/index"); ?>">Score - Home</a>
</div>
<br><br><br>

