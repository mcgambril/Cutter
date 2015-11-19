<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/27/2015
 * Time: 10:45 PM
 */
 -->

<div class="page-header">
    <h1>Password<small></small></h1>
</div>
<br />
<br />

<?php echo validation_errors(); ?>

<?php echo form_open('admin/submitPass') ?>

    <div class="form-group" style="padding-left:10%;">
        <label for="pwd">Password:</label>
        <input type="password" name="password" class="form-control" style="width:50%;">
        <br>
        <input type="submit" class="btn btn-default" value="Submit" name="submit">
        <a class="btn btn-default" href="<?php echo base_url("index.php/home/index"); ?>">Back</a>
    </div>

</form>


