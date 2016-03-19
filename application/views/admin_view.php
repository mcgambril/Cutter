<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/27/2015
 * Time: 10:45 PM
 */
 -->

<div class="page-header">
    <h1>Admin - <small>Login</small></h1>
</div>
<br />
<br />

<?php echo validation_errors(); ?>

<?php echo form_open('admin/submitPass') ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4 leftPadFive">
                <div class="col-md-12">
                    <label for="pwd">Password:</label>
                    <input type="password" name="password" class="form-control col-md-12">
                </div>
                <br>
                <div class="text-center col-md-12">
                    <br>
                    <input type="submit" class="btn btn-default col-md-6" value="Submit" name="submit">
                    <a class="btn btn-default col-md-6" href="<?php echo base_url("home/index"); ?>">Back</a>
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>
</form>


