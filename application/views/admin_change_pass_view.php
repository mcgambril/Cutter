<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 1/7/2016
 * Time: 7:03 PM
 */
 -->

<div class="page-header">
    <h1>Change Password</h1>
</div>
<br />
<br />

<?php echo validation_errors(); ?>

<?php echo form_open('admin/submitChangePassword') ?>
    <div class="container">
        <div class="form-group">
            <div class="row">
                <div class="col-md-5 leftPadFive">
                    <table>
                        <tbody>
                            <tr>
                                <td class="col-md-6 changePassHeaders">Current Password:</td>
                                <td class="col-md-7"><input type="password" name="password" class="form-control col-md-12"></td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><br><br></td>
                                <td class="col-md-7"><br><br></td>
                            </tr>
                            <tr>
                                <td class="col-md-5 changePassHeaders">New Password:</td>
                                <td class="col-md-7"><input type="password" name="newPass" class="form-control col-md-12"></td>
                            </tr>
                            <tr>
                                <td class="col-md-5 changePassHeaders">Confirm New Password:</td>
                                <td class="col-md-7"><input type="password" name="confirmPass" class="form-control col-md-12"></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="text-center col-md-12">
                        <br>
                        <input type="submit" class="btn btn-default col-md-6" value="Change Password" name="submit">
                        <a class="btn btn-default col-md-6" href="<?php echo base_url("index.php/admin/loadHomeLoggedIn"); ?>">Home</a>
                        <br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>