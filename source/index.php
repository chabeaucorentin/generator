<?php
	/* ---------------------------------
	--------------- MODEL --------------
	--------------------------------- */
	include("content/includes/model.php");

	$fields = get_last_fields();
	$nb_fields = get_nb_fields();
	$wordings = get_last_wordings();
	$nb_wordings = get_nb_wordings();

	$header = define_header($nb_fields, $nb_wordings);

	$types = array(
		"number" => "Nombre",
		"text" => "Texte",
		"image" => "Image"
	);

	$page = array(
		"link" => $config["sitelink"] . "/",
		"title" => "Tableau de bord"
	);

	mysqli_close($db);

	/* ---------------------------------
	---------------- VUE ---------------
	--------------------------------- */
	include("content/vues/index.php");
