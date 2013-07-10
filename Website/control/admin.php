<?php
	require_once '../model/admin.php';


	$row = get_unapproved();

	require_once '../view/admin.php';

	print_unapproved($row);

?>