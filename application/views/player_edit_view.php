<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:27 PM
 */
 -->

<p>This is the player edit view</p>

<div class="container">
    <div class="page-header">
        <h1>Player - <small>Edit</small></h1>
    </div>
</div>

<?php echo validation_errors(); ?>

<?php echo form_open('player/submitEditPlayer') ?>
<div class="form-group">
    <div class="container">
        <div class="row">
            <?php foreach ($getPlayerByIDQuery as $row) {
                echo '<h4>' . $row->playerName . '</h4>';
            }?>
            <br>
            <h4>Enter the new name for this player:</h4><br>
            <div class="col-md-3">
                <input type="hidden" name="playerID" value="<?php $row->playerID ?>" />
                <p>First Name: <input type="text" name="newFirstName" id="newFirstName" class="form-control"></p>
                <p>Last Name: <input type="text" name="newLastName" id="newLastName" class="form-control"></p>
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