<?php
	/* ---------------------------------
	--------------- MODEL --------------
	--------------------------------- */
	include("content/includes/model.php");

	$wordings = get_wordings();
	$nb_wordings = count($wordings);

	$header = define_header(-1, $nb_wordings);

	$page = array(
		"link" => $config["sitelink"] . "/wordings",
		"title" => "Gestion des énoncés"
	);

	mysqli_close($db);

	/* ---------------------------------
	---------------- VUE ---------------
	--------------------------------- */
	include("content/vues/wordings.php");
