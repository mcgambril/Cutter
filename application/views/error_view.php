<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 1/10/2016
 * Time: 9:56 PM
 */
 -->

<div class="text-center">
    <h1>Error!</h1>
    <br>
    <h4><?php echo $errorMessage; ?></h4>
    <h4></h4>
    <br><br>
</div>

<div class="row">
    <div class="text-center col-md-12">
        <p class="col-md-5"></p>
        <a class="btn btn-default col-md-2" href="<?php echo base_url($link); ?>"><?php echo $buttonText; ?></a>
        <p class="col-md-5"></p>
    </div>
</div>
<br><br><br>