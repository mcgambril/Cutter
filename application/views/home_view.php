
<!--/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/16/2015
 * Time: 9:14 PM
 *Cutter/application/views/home_view.php
 */
 -->

	<h1>Home</h1>
    <h2>
        <?php
            foreach($query as $row) {
                echo $row->courseID;echo ' ';
                echo $row->name; echo ' ';
                echo $row->slope; echo ' ';
                echo $row->rating;echo ' ';
                echo $row->default; echo "</br>";
            }
        ?>
    </h2>
    <h2><button type="button" class="btn btn-default">Default</button></h2>

