<?php
	// Model-View-Controller implementation of Task Manager
	include 'header.php';

	require('TasksController.php');
	$controller = new TasksController();
	$controller->run();
?>