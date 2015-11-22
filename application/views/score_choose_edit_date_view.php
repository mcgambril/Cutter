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
            <h4>Choose the date whose scores you would like to Edit:</h4><br>
            <div class="col-md-3">
                <p>Date: <input type="text" name="datepicker" id="datepicker" class="form-control" data-date-format="yyyy-mm-dd"></p>
                <br />
                <div class="text-center">
                    <input type="submit" class="btn btn-default" value="Submit Date" name="submit">
                    <a class="btn btn-default" href="<?php echo base_url("index.php/score/index"); ?>">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
</form>