<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:27 PM
 */
 -->
<div class="page-header">
    <h1>Player - <small>Add</small></h1>
</div>

<?php echo validation_errors(); ?>

<?php echo form_open('player/submitNewPlayer') ?>
<div class="form-group">
    <div class="container">
        <div class="row">
            <h4>Enter the name of the player you would like to add to the group:</h4><br>
            <div class="col-md-3">
                <p>First Name: <input type="text" name="firstName" id="firstName" class="form-control"></p>
                <p>Last Name: <input type="text" name="lastName" id="lastName" class="form-control"></p>
                <br />
                <div class="text-center">
                    <input type="submit" class="btn btn-default" value="Add Player" name="submitName">
                    <a class="btn btn-default" href="<?php echo base_url("index.php/player/index"); ?>">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
