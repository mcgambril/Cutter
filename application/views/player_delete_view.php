<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:28 PM
 */
 -->

<?php echo validation_errors(); ?>

<?php echo form_open('player/submitDelete') ?>

<div class="container">
    <div class="page-header">
        <?php foreach($getPlayerByIDQuery as $row) {
            echo '<h1>' . $row->playerName . ' - <small>Delete Player</small></h1>';
        }?>
    </div>

    <div class="row">
        <div class="col-md-5">
            <?php foreach($getPlayerByIDQuery as $row) {
                echo '
                    <div class="panel panel-default">
                        <div class="panel-heading">' . $row->playerName . '&#39s Current Information</div>
                        <div class="table-responsive">
                            <table class ="table table-condensed table-bordered" style="border-collapse:collapse;">
                                <thead>
                                    <tr>
                                        <th class="col-md-6">Name</th>
                                        <th class="col-md-3 centered">Handicap</th>
                                        <th class="col-md-3 centered">Index</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-md-6">' . $row->playerName . '</td>
                                        <td class="col-md-3 centered">' . $row->playerHandicap . '</td>
                                        <td class="col-md-3 centered">' . $row->playerHandicapIndex . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                ';
            }?>
            <br>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="container">
        <div class="row">
            <div class="text-center col-md-5">
                <h3>Are you sure you want to Delete this player from the database?</h3>
                <br>
                <?php echo '<input type = "hidden" name = "playerID" value = "' . $row->playerID . '" />'; ?>
                <p class="col-md-2"></p>
                <input type="submit" class="btn btn-default col-md-4" value="Yes. Delete Player" name="submitName">
                <a class="btn btn-default col-md-4" href="<?php echo base_url("player/index"); ?>">Back</a>
                <p class="col-md-2"></p>
            </div>
        </div>
    </div>
</div>
</form>