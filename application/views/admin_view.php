<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/27/2015
 * Time: 10:45 PM
 */
 -->

<h1>Password?</h1>
<br />
<br />

<?php echo validation_errors(); ?>

<?php echo form_open('admin/submitPass') ?>

<div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" name="password" class="form-control">
    <br>
    <input type="submit" class="btn btn-default" value="Submit" name="submit">
    <a class="btn btn-default" href="<?php echo base_url("index.php/home/index"); ?>">Back</a>
</div>

</form>


