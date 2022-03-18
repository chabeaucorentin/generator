<?php
	/* ---------------------------------
	--------------- MODEL --------------
	--------------------------------- */
	include("content/includes/model.php");

	$name = (isset($_POST["name"])) ? htmlspecialchars($_POST["name"], ENT_QUOTES) : $settings["name"];
	$description = (isset($_POST["description"])) ? htmlspecialchars($_POST["description"], ENT_QUOTES) : $settings["description"];
	$keywords = (isset($_POST["keywords"])) ? htmlspecialchars($_POST["keywords"], ENT_QUOTES) : $settings["keywords"];
	$delimiter = (isset($_POST["delimiter"])) ? htmlspecialchars($_POST["delimiter"], ENT_QUOTES) : $settings["delimiter"];
	$theme = (isset($_POST["design"])) ? htmlspecialchars($_POST["design"], ENT_QUOTES) : $settings["theme"];

	if (isset($_POST["name"]) || isset($_POST["description"]) || isset($_POST["keywords"]) || isset($_POST["delimiter"]) || isset($_POST["design"])) {
		$data = array(
			"name" => $name,
			"description" => $description,
			"keywords" => $keywords,
			"delimiter" => $delimiter,
			"theme" => $theme
		);

		$errors = get_settings_errors($data);
		$check = $errors["name"]["valid"] && $errors["description"]["valid"] && $errors["keywords"]["valid"] && $errors["delimiter"]["valid"] && $errors["theme"]["valid"];

		if ($check) {
			edit_settings($data);
			$settings = get_settings();
		}
	}

	$page = array(
		"link" => $config["sitelink"] . "/settings",
		"title" => "Gestion des paramètres"
	);

	mysqli_close($db);

	/* ---------------------------------
	---------------- VUE ---------------
	--------------------------------- */
	include("content/vues/settings.php");
