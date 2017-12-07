<?php
	include 'header.php';

	require('FinalProjectController.php');
	$controller = new FinalProjectController();
	$controller->run();
?>