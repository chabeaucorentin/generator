<?php
	/* ---------------------------------
	--------------- MODEL --------------
	--------------------------------- */
	include("content/includes/model.php");

	$field_id = (isset($_GET["field_id"])) ? $_GET["field_id"] : NULL;

	if (isset($field_id) && check_field_id($field_id)) {
		$actions = array("add", "edit", "delete");
		$action = (isset($_GET["action"])) ? $_GET["action"] : NULL;
		$id = (isset($_GET["id"]) && is_numeric($_GET["id"])) ? (intval($_GET["id"]) - 1) : NULL;

		$content = get_field($field_id)["content"];

		if (isset($action) && in_array($action, $actions) && (isset($id) && check_subfield_id($content, $id) || $action == "add")) {
			if ($action == "add" || $action == "edit") {
				$types = array(
					"text" => "Texte",
					"image" => "Image"
				);
				$type = get_field_type($field_id);

				if (in_array($type, array_keys($types))) {
					if ($type == "text") {
						$data = (isset($_POST["text"])) ? htmlspecialchars($_POST["text"], ENT_QUOTES) : NULL;
					} else {
						$data = (isset($_FILES["file"])) ? $_FILES["file"] : NULL;
					}

					if (isset($data)) {
						$errors = get_subfield_errors($type, $data);

						if ($errors["valid"]) {
							$data = (isset($errors["image_path"])) ? $errors["image_path"] : $data;

							if ($action == "add") {
								add_subfield($field_id, $content, $data);
							} else {
								edit_subfield($field_id, $id, $content, $data);
							}

							header("Location: " . $config["sitelink"] . "/field/edit/" . $field_id);
							exit();
						}
					}

					if ($action == "edit") {
						$data = $content[$id];
					}

					$page = array(
						"link" => $config["sitelink"] . "/subfield/" . $field_id . "/" . $action . ($action == "add" ? "" : "/" . ($id + 1)),
						"title" => ($action == "add") ? (($type == "text") ? "Ajout d'un texte" : "Ajout d'une image") : (($type == "text") ? "Modification d'un texte" : "Modification d'une image"),
						"breadcrumb" => ($action == "add") ? "Ajouter" : "Modifier",
						"btn_text" => ($action == "add") ? (($type == "text") ? "Ajouter le texte" : "Ajouter l'image") : (($type == "text") ? "Modifier le texte" : "Modifier l'image"),
					);
				} else {
					header("Location: " . $config["sitelink"] . "/fields");
					exit();
				}
			} else {
				delete_subfield($field_id, $id, $content);

				header("Location: " . $config["sitelink"] . "/field/edit/" . $field_id);
				exit();
			}
		} else {
			header("Location: " . $config["sitelink"] . "/field/edit/" . $field_id);
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
	include("content/vues/subfield.php");
