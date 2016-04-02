<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 1/4/2016
 * Time: 11:21 PM
 */
 -->

<?php echo form_open('score/submitDate') ?>
    <div class="form-group">
        <div class="container">
            <div class="page-header">
                <h1>Scores</small></h1>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4>Pick the date you would like to post/edit scores for:</h4>
                    <br>
                    <div class="col-md-6">
                        <?php echo validation_errors(); ?>
                        <p><strong>Date:  </strong></p>
                        <input type="text" name="datepicker" id="datepicker" class="form-control"> <!--data-date-format="mm-dd-yyyy"--> <!--"yyyy-mm-dd"-->
                        <br>
                        <input type="submit" class="btn btn-default col-md-6" value="Post Scores" name="submit">
                        <input type="submit" class="btn btn-default col-md-6" value="Edit Scores" name="submit">
                        <br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>