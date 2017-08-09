<?php
	require_once('db.php');
	$branchId = mysql_real_escape_string($_POST['branchId']);
	if($branchId!='')
	{
		$states_result = $conn->query('select * from tbl_schedules where branchId='.$branchId.'');
		$options = "<option value=''>Schedule</option>";
		while($row = $states_result->fetch_assoc()) {
		$options .= "<option value='".$row['id']."'>".$row['state']."</option>";
	}
		echo $options;
	}
?>