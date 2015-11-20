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
    print_r(array($data3)); echo '<br><br><br>';
?>
<div class="text-center">
<a class="btn btn-default" href="<?php echo base_url("index.php/score/index"); ?>">Score - Home</a>
</div>
<br><br><br>

