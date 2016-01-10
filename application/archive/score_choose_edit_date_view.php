<!--
    /**
     * Created by PhpStorm.
     * User: Matthew
     * Date: 11/22/2015
     * Time: 3:09 PM
     */
 -->

<div class="page-header">
    <h1>Score - <small>Edit Date</small></h1>
</div>

<?php echo validation_errors(); ?>

<?php echo form_open('score/postEditDate') ?>
    <div class="form-group">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>Enter (yyyy-mm-dd) or pick the date you would like to edit scores for:</h4>
                    <br>
                    <div class="col-md-6">
                        <p><strong>Date:  </strong></p>
                        <input type="text" name="datepicker" id="datepicker" class="form-control" data-date-format="yyyy-mm-dd">
                        <br />
                        <input type="submit" class="btn btn-default col-md-6" value="Submit Date" name="submit">
                        <a class="btn btn-default col-md-6" href="<?php echo base_url("index.php/score/index"); ?>">Back</a>
                        <br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>