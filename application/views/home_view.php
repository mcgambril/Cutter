
<!--/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/16/2015
 * Time: 9:14 PM
 */
 -->

<html>
<head>
<title>My Blog</title>
</head>
<body>
	<h1>Home</h1>
    <h1>
        <?php
            foreach($query as $row) {
                echo $row->courseID;echo ' ';
                echo $row->name; echo ' ';
                echo $row->slope; echo ' ';
                echo $row->rating;echo ' ';
                echo $row->default; echo ' ';
            }
        ?>
    </h1>
</body>
</html>
