<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/28/2015
 * Time: 9:27 PM
 */
 -->

<?php echo form_open('player/submitNewPlayer') ?>
<div class="form-group">
    <div class="container">
        <div class="page-header">
            <h1>Player - <small>Add</small></h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4>Enter the name of the player you would like to add to the group:</h4>
                <br>
                <?php echo validation_errors(); ?>
                <table class="col-md-8">
                    <tbody>
                        <tr>
                            <td class="headingLeft col-md-4">First Name:  </td>
                            <td class="centered tableData col-md-8 bottomPadTiny">
                                <input type="text" name="firstName" id="firstName" class="form-control col-md-12">
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td class="headingLeft col-md-4">Last Name:  </td>
                            <td class="centered tableData col-md-8 bottomPadTiny">
                                <input type="text" name="lastName" id="lastName" class="form-control col-md-12">
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td class="headingLeft col-md-4">Phone #:  </td>
                            <td class="centered tableData col-md-8 bottomPadTiny">
                                <input type="number" name="phoneNumber" id="phoneNumber" class="form-control col-md-12">
                                <br>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center col-md-8">
                    <br><br>
                    <input type="submit" class="btn btn-default col-md-6" value="Add Player" name="submitName">
                    <a class="btn btn-default col-md-6" href="<?php echo base_url("player/index"); ?>">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
