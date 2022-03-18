<?php
	/* ---------------------------------
	--------------- MODEL --------------
	--------------------------------- */
	include("content/includes/model.php");

	$fields = get_fields();
	$nb_fields = count($fields);

	$header = define_header($nb_fields, -1);

	$types = array(
		"number" => "Nombre",
		"text" => "Texte",
		"image" => "Image"
	);

	$page = array(
		"link" => $config["sitelink"] . "/fields",
		"title" => "Gestion des champs aléatoires"
	);

	mysqli_close($db);

	/* ---------------------------------
	---------------- VUE ---------------
	--------------------------------- */
	include("content/vues/fields.php");
