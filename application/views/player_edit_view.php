<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:27 PM
 */
 -->

<div class="container">
    <div class="page-header">
        <?php foreach($getPlayerByIDQuery as $row) {
            echo '<h1>' . $row->playerName . ' - <small>Edit Player</small></h1>';
        }?>
    </div>

    <div class="row">
        <div class="col-md-5">
            <?php
                foreach($getPlayerByIDQuery as $row) {
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
                }
            ?>
        </div>
    </div>

</div>

<?php echo form_open('player/submitEditPlayer') ?>
<div class="form-group">
    <div class="container">
        <div class="row">
            <br>
            <?php echo validation_errors(); ?>
            <div class="col-md-5">
                <?php foreach ($getPlayerByIDQuery as $row) {
                    echo '<input type = "hidden" name = "playerID" value = "' . $row->playerID . '" />';
                }?>
                <h4>Enter the new name for this player:</h4><br>
                <table>
                    <tbody>
                        <tr>
                            <td class="headingLeft col-md-3">First Name:  </td>
                            <td class="centered col-md-9 bottomPadTiny">
                                <input type="text" name="newFirstName" id="newFirstName" class="form-control col-md-12">
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td class="headingLeft col-md-3">Last Name:  </td>
                            <td class="centered col-md-9 bottomPadTiny">
                                <input type="text" name="newLastName" id="newLastName" class="form-control col-md-12">
                                <br>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br />
            </div>
        </div>
        <div class="row">
            <div class="text-center col-md-5">
                <div class="col-md-2"></div>
                <input type="submit" class="btn btn-default col-md-4" value="Submit Changes" name="submitName">
                <a class="btn btn-default col-md-4" href="<?php echo base_url("player/index"); ?>">Back</a>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</div>
</form>