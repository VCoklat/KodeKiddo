<?php
	$conn = new mysqli('localhost', 'root', '', 'cias');
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

?>