<?php
	/* ---------------------------------
	--------------- MODEL --------------
	--------------------------------- */
	include("content/includes/model.php");

	$actions = array("add", "edit", "delete");
	$action = (isset($_GET["action"])) ? $_GET["action"] : NULL;
	$type = (isset($_GET["type"])) ? $_GET["type"] : NULL;
	$id = (isset($_GET["id"])) ? $_GET["id"] : NULL;

	if (isset($action) && in_array($action, $actions) && (isset($id) && check_field_id($id) || $action == "add")) {
		if (($action == "add" && isset($type)) || $action == "edit") {
			$types = array(
				"number" => "Nombre",
				"text" => "Texte",
				"image" => "Image"
			);
			$type = ($action == "edit") ? get_field_type($id) : $type;

			if (in_array($type, array_keys($types))) {
				$code = (isset($_POST["code"])) ? htmlspecialchars($_POST["code"], ENT_QUOTES) : NULL;
				$lower = (isset($_POST["lower"])) ? htmlspecialchars($_POST["lower"], ENT_QUOTES) : NULL;
				$higher = (isset($_POST["higher"])) ? htmlspecialchars($_POST["higher"], ENT_QUOTES) : NULL;
				$increase = (isset($_POST["increase"])) ? htmlspecialchars($_POST["increase"], ENT_QUOTES) : NULL;

				if ($action == "edit") {
					$field = get_field($id);
					$content = $field["content"];

					if ($type != "number") {
						$subfields = array(
							"card_title" => ($type == "text") ? "Liste des textes" : "Liste des images",
							"table_id" => ($type == "text") ? "ID du texte" : "ID de l'image",
							"btn_text" => ($type == "text") ? "Ajouter un texte" : "Ajouter une image",
							"modal_title" => ($type == "text") ? "Suppression d'un texte" : "Suppression d'une image"
						);
					}
				}

				if (isset($code) || isset($lower) || isset($higher) || isset($increase)) {
					if ($type == "number") {
						$data = array(
							"lower" => (is_numeric($lower)) ? intval($lower) : $lower,
							"higher" => (is_numeric($higher)) ? intval($higher) : $higher,
							"increase" => (is_numeric($increase)) ? floatval($increase) : $increase
						);

						$errors = get_field_errors($id, $code, $data);
						$check = $errors["code"]["valid"] && $errors["lower"]["valid"] && $errors["higher"]["valid"] && $errors["increase"]["valid"];
					} else {
						$errors = get_field_errors($id, $code);
						$check = $errors["code"]["valid"];
					}

					if ($check) {
						if ($action == "add") {
							$id = add_field($type, $code);
						} else {
							edit_field($id, $code);
						}

						if ($type == "number") {
							edit_content($id, $data);

							if ($action == "add") {
								header("Location: " . $config["sitelink"] . "/fields");
								exit();
							}
						} else if ($action == "add") {
							header("Location: " . $config["sitelink"] . "/field/edit/" . $id);
							exit();
						}
					}
				} else if ($action == "edit") {
					$code = $field["code"];

					if ($type == "number") {
						$lower = $content["lower"];
						$higher = $content["higher"];
						$increase = $content["increase"];
					}
				}

				$placeholders = array(
					"number" => "temperature",
					"text" => "nom",
					"image" => "couleur"
				);

				$page = array(
					"link" => $config["sitelink"] . "/field/" . $action . "/" . ($action == "add" ? $type : $id),
					"title" => ($action == "add") ? "Ajout d'un champ aléatoire" : "Modification d'un champ aléatoire",
					"breadcrumb" => ($action == "add") ? "Ajouter" : "Modifier",
					"card_title" => "Informations concernant le champ aléatoire",
					"placeholder" => $placeholders[$type],
					"btn_text" => ($action == "add") ? "Ajouter le champ" : "Modifier le champ"
				);
			} else if ($action == "add") {
				header("Location: " . $config["sitelink"] . "/field/add");
				exit();
			} else {
				header("Location: " . $config["sitelink"] . "/fields");
				exit();
			}
		} else if ($action == "add") {
			$page = array(
				"link" => $config["sitelink"] . "/field/add",
				"title" => "Ajout d'un champ aléatoire",
				"breadcrumb" => "Ajouter",
				"card_title" => "Sélectionnez le type de champ"
			);
		} else {
			delete_field($id);

			header("Location: " . $config["sitelink"] . "/fields");
			exit();
		}
	} else {
		header("Location: " . $config["sitelink"] . "/fields");
		exit();
	}

	mysqli_close($db);

	/* ---------------------------------
	---------------- VUE ---------------
	--------------------------------- */
	include("content/vues/field.php");
