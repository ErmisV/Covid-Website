<?php

$db = mysqli_connect("localhost","root","","web2022") or die("Unable to connect");

	if (mysqli_connect_errno())
    {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
?>
