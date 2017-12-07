<?php
	// Model-View-Controller implementation of Task Manager
	//include 'header.php';

	require('FinalProjectController.php');
	$controller = new FinalProjectController();
	$controller->run();
?>