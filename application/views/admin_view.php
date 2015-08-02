<!--
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/27/2015
 * Time: 10:45 PM
 */
 -->

<h1>Password?</h1>

<form>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
    <button type="button" class="btn btn-default">
            <a href="<?php echo base_url("index.php/home/index"); ?>">Back</a>
    </button>
</form>