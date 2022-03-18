<?php
	/* ---------------------------------
	--------------- MODEL --------------
	--------------------------------- */
	include("content/includes/model.php");

	$actions = array("add", "edit", "generate", "delete");
	$action = (isset($_GET["action"])) ? $_GET["action"] : NULL;
	$id = (isset($_GET["id"])) ? $_GET["id"] : NULL;

	if (isset($action) && in_array($action, $actions) && (isset($id) && check_wording_id($id) || $action == "add")) {
		if ($action == "add" || $action == "edit") {
			$title = (isset($_POST["title"])) ? htmlspecialchars($_POST["title"], ENT_QUOTES) : NULL;
			$content = (isset($_POST["content"])) ? htmlspecialchars($_POST["content"], ENT_QUOTES) : NULL;

			if (isset($title) || isset($content)) {
				$errors = get_wording_errors($title, $content);
				$check = $errors["title"]["valid"] && $errors["content"]["valid"];

				if ($check) {
					if ($action == "add") {
						add_wording($title, $content);

						header("Location: " . $config["sitelink"] . "/wordings");
						exit();
					} else {
						edit_wording($id, $title, $content);
					}
				}
			} else if ($action == "edit") {
				$wording = get_wording($id);
				$title = $wording["title"];
				$content = $wording["content"];
			}

			$page = array(
				"link" => $config["sitelink"] . "/wording/" . $action . ($action == "add" ? "" : "/" . $id),
				"title" => ($action == "add") ? "Ajout d'un énoncé" : "Modification d'un énoncé",
				"breadcrumb" => ($action == "add") ? "Ajouter" : "Modifier",
				"card_title" => "Informations concernant l'énoncé",
				"btn_text" => ($action == "add") ? "Ajouter l'énoncé" : "Modifier l'énoncé"
			);
		} else if ($action == "generate") {
			$wording = get_wording($id);

			$page = array(
				"link" => $config["sitelink"] . "/wording/" . $action . "/" . $id,
				"title" => $wording["title"],
				"card_title" => "Consignes de l'énoncé"
			);

			$content = generate_wording($wording["content"]);

			//header("Content-Type: text/html");
			//header("Content-Disposition: attachment; filename=enonce-" . $id . ".html");
		} else {
			delete_wording($id);

			header("Location: " . $config["sitelink"] . "/wordings");
			exit();
		}
	} else {
		header("Location: " . $config["sitelink"] . "/wordings");
		exit();
	}

	mysqli_close($db);

	/* ---------------------------------
	---------------- VUE ---------------
	--------------------------------- */
	include("content/vues/wording.php");
