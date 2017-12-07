<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

<div class="col-md-10 offset-md-1">
<?php
	include 'header.php';
	require('FinalProjectController.php');
	$controller = new FinalProjectController();
	$controller->run();
?>
     </div>