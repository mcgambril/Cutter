<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 8/13/2015
 * Time: 11:31 PM
 */-->

<div class="page-header">
    <h1>Score - <small>Post Date</small></h1>
</div>

<?php echo validation_errors(); ?>

<?php echo form_open('score/submitDate') ?>
    <div class="form-group">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>Pick or enter a date (yyyy-mm-dd) to enter new scores for:</h4><br>
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