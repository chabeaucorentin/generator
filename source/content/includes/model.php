<?php
	/* ---------------------------------
	-------------- CONFIG --------------
	--------------------------------- */
	require("content/includes/config.php");

	/* ---------------------------------
	-------------- HEADERS -------------
	--------------------------------- */
	require("content/includes/headers.php");

	/* ---------------------------------
	------------- FUNCTIONS ------------
	--------------------------------- */

		/* ---------------------------------
		--------------- INDEX --------------
		--------------------------------- */
		function define_header($nb_fields, $nb_wordings) {
			global $headers;

			if (($nb_fields == 0 && $nb_wordings >= 0) || $nb_wordings < 0) {
				$type = "fields";
				$nb = $nb_fields;
			} else {
				$type = "wordings";
				$nb = $nb_wordings;
			}

			if ($nb > 1) {
				$s = "x";
			} else {
				$s = "$nb";
			}

			$header = array(
				"type" => $headers[$type]["type"],
				"image" => $headers[$type][$s]["image"],
				"title" => $headers[$type][$s]["title"],
				"desc" => $headers[$type][$s]["desc"],
				"nb_text" => $headers[$type]["nb_text"],
				"nb" => $nb,
				"btn_text" => $headers[$type]["btn_text"]
			);

			return $header;
		}

		function get_last_fields() {
			global $db;

			$req = "SELECT * FROM fields ORDER BY field_id DESC LIMIT 5";
			$res = mysqli_query($db, $req);
			$res = mysqli_fetch_all($res, MYSQLI_ASSOC);

			return $res;
		}

		function get_nb_fields() {
			global $db;

			$req = "SELECT * FROM fields";
			$res = mysqli_query($db, $req);
			$res = mysqli_num_rows($res);

			return $res;
		}

		function get_last_wordings() {
			global $db;

			$req = "SELECT * FROM wordings ORDER BY wording_id DESC LIMIT 5";
			$res = mysqli_query($db, $req);
			$res = mysqli_fetch_all($res, MYSQLI_ASSOC);

			return $res;
		}

		function get_nb_wordings() {
			global $db;

			$req = "SELECT * FROM wordings";
			$res = mysqli_query($db, $req);
			$res = mysqli_num_rows($res);

			return $res;
		}

		/* ---------------------------------
		-------------- FIELDS --------------
		--------------------------------- */
		function get_fields() {
			global $db;

			$req = "SELECT * FROM fields ORDER BY field_id ASC";
			$res = mysqli_query($db, $req);
			$res = mysqli_fetch_all($res, MYSQLI_ASSOC);

			return $res;
		}

		/* ---------------------------------
		--------------- FIELD --------------
		--------------------------------- */
		function get_field_errors($id, $code, $data = NULL) {
			if ($code == "") {
				$msg_code = "Le code du champ ne peut pas être vide !";
			} else if (strlen($code) > 50) {
				$msg_code = "Le code du champ ne peut pas excéder 50 caractères !";
			} else if (!preg_match("#^[a-z0-9_]{1,50}$#", $code)) {
				$msg_code = "Le code du champ ne peut contenir que des caractères alphabétiques en minuscule et sans accent, des chiffres et des tirets bas (_) !";
			} else if (check_field_code($id, $code)) {
				$msg_code = "Le code du champ existe déjà !";
			}

			$errors = array(
				"code" => array(
					"valid" => !isset($msg_code),
					"message" => (!isset($msg_code)) ?: $msg_code
				)
			);

			if (isset($data)) {
				foreach ($data as $key => $value) {
					$msg_data = NULL;

					if (!is_numeric($value)) {
						$msg_data = "Le contenu du champ est incorrect, veuillez entrer un nombre !";
					} else if ($key == "lower" && $data["lower"] < 0) {
						$msg_data = "Le contenu du champ doit être suppérieur ou égal à 0 !";
					} else if ($key == "higher" && $errors["lower"]["valid"] && $data["lower"] >= $data["higher"]) {
						$msg_data = "La borne supérieure doit être plus élevée que la borne inférieure !";
					} else if ($key == "increase" && $data["increase"] <= 0) {
						$msg_data = "Le pas doit être suppérieur à 0 !";
					} else if ($key == "increase" && $errors["lower"]["valid"] && $errors["higher"]["valid"] && $data["increase"] > $data["higher"] - $data["lower"]) {
						$msg_data = "Le pas doit être inférieur ou égal à " . ($data["higher"] - $data["lower"]) . " !";
					}

					$errors[$key] = array(
						"valid" => !isset($msg_data),
						"message" => (!isset($msg_data)) ?: $msg_data
					);
				}
			}

			return $errors;
		}

		function check_field_id($id) {
			global $db;

			$req = "SELECT * FROM fields WHERE field_id = ?";
			$stmt = mysqli_prepare($db, $req);
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);

			if (mysqli_stmt_num_rows($stmt) > 0) {
				$res = true;
			} else {
				$res = false;
			}

			mysqli_stmt_close($stmt);

			return $res;
		}

		function get_field_type($id) {
			global $db;

			$req = "SELECT field_type FROM fields WHERE field_id = ?";
			$stmt = mysqli_prepare($db, $req);
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $type);

			mysqli_stmt_fetch($stmt);

			$res = $type;

			mysqli_stmt_close($stmt);

			return $res;
		}

		function check_field_code($id, $code) {
			global $db;

			$req = "SELECT * FROM fields WHERE" . (isset($id) ? " field_id != ? AND" : "") . " field_code = ?";
			$stmt = mysqli_prepare($db, $req);
			if (isset($id)) {
				mysqli_stmt_bind_param($stmt, "is", $id, $code);
			} else {
				mysqli_stmt_bind_param($stmt, "s", $code);
			}
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);

			if (mysqli_stmt_num_rows($stmt) > 0) {
				$res = true;
			} else {
				$res = false;
			}

			mysqli_stmt_close($stmt);

			return $res;
		}

		function get_field($id) {
			global $db;

			$req = "SELECT field_code, field_content FROM fields WHERE field_id = ?";
			$stmt = mysqli_prepare($db, $req);
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $code, $content);

			mysqli_stmt_fetch($stmt);

			$res = array(
				"code" => $code,
				"content" => unserialize($content)
			);

			mysqli_stmt_close($stmt);

			return $res;
		}

		function add_field($type, $code) {
			global $db;

			$req = "INSERT INTO fields (field_type, field_code) VALUES (?, ?)";
			$stmt = mysqli_prepare($db, $req);
			mysqli_stmt_bind_param($stmt, "ss", $type, $code);
			mysqli_stmt_execute($stmt);

			$res = mysqli_stmt_insert_id($stmt);

			mysqli_stmt_close($stmt);

			return $res;
		}

		function edit_field($id, $code) {
			global $db;

			$req = "UPDATE fields SET field_code = ? WHERE field_id = ?";
			$stmt = mysqli_prepare($db, $req);
			mysqli_stmt_bind_param($stmt, "si", $code, $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		function delete_field($id) {
			global $config, $db;

			if (get_field_type($id) == "image") {
				$subfields = get_field($id)["content"];

				foreach ($subfields as $subfield) {
					unlink($config["uploads"] . "/" . $subfield);
				}
			}

			$req = "DELETE FROM fields WHERE field_id = ?";
			$stmt = mysqli_prepare($db, $req);
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		function edit_content($id, $data) {
			global $db;

			$content = serialize($data);

			$req = "UPDATE fields SET field_content = ? WHERE field_id = ?";
			$stmt = mysqli_prepare($db, $req);
			mysqli_stmt_bind_param($stmt, "si", $content, $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		/* ---------------------------------
		------------- SUBFIELD -------------
		--------------------------------- */
		function get_subfield_errors($type, $data) {
			global $config;

			if ($type == "text") {
				if ($data == "") {
					$msg_data = "Le texte ne peut pas être vide !";
				} else if (strlen($data) > 255) {
					$msg_data = "Le texte ne peut pas excéder 255 caractères !";
				}
			} else {
				$image_name = basename($data["name"]);
				$image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

				do {
					$code = generate_code(10);
					$image_path = $config["uploads"] . "/" . $code . "." . $image_ext;
				} while (file_exists($image_path));

				if ($data["error"]) {
					if ($data["error"] == 1) {
						$msg_data = "Le fichier envoyé dépasse la valeur upload_max_filesize située dans le fichier php.ini !";
					} else if ($data["error"] == 2) {
						$msg_data = "Le fichier envoyé dépasse la directive MAX_FILE_SIZE spécifiée dans le formulaire HTML !";
					} else if ($data["error"] == 3) {
						$msg_data = "Le fichier envoyé n'a été téléversé que partiellement !";
					} else if ($data["error"] == 4) {
						$msg_data = "Veuillez mettre en ligne une image !";
					} else if ($data["error"] == 6) {
						$msg_data = "Absence de dossier temporaire !";
					} else if ($data["error"] == 7) {
						$msg_data = "Erreur d'écriture sur le disque !";
					} else if ($data["error"] == 8) {
						$msg_data = "Une extension PHP a arrêté l'envoi du fichier !";
					} else {
						$msg_data = "Une erreur s'est produite !";
					}
				} else if (!getimagesize($data["tmp_name"])) {
					$msg_data = "Le fichier n'est pas une image !";
				} else if ($data["size"] > 2097152) {
					$msg_data = "L'image ne peut pas excéder 2 Mo !";
				} else if (!in_array($image_ext, array("jpg", "jpeg", "png", "gif"))) {
					$msg_data = "L'image doit-être au format JPG, JPEG, PNG ou GIF !";
				} else if (!move_uploaded_file($data["tmp_name"], $image_path)) {
					$msg_data = "Une erreur s'est produite lors de la mise en ligne !";
				}
			}

			$errors = array(
				"valid" => !isset($msg_data),
				"message" => (!isset($msg_data)) ?: $msg_data,
				"image_path" => ($type == "image") ? $code . "." . $image_ext : NULL
			);

			return $errors;
		}

		function generate_code($size) {
			$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$length = strlen($characters);
			$code = "";

			for ($i = 0; $i < $size; $i++) {
				$rand = rand(0, $length - 1);
				$code .= $characters[$rand];
			}

			return $code;
		}

		function check_subfield_id($content, $id) {
			global $db;

			if (in_array($id, array_keys($content))) {
				$res = true;
			} else {
				$res = false;
			}

			return $res;
		}

		function add_subfield($field_id, $content, $data) {
			$fcontent = $content;
			$fcontent[] = $data;

			edit_content($field_id, $fcontent);
		}

		function edit_subfield($field_id, $id, $content, $data) {
			global $config;
			$fcontent = $content;

			if (get_field_type($field_id) == "image") {
				unlink($config["uploads"] . "/" . $fcontent[$id]);
			}

			$fcontent[$id] = $data;

			edit_content($field_id, $fcontent);
		}

		function delete_subfield($field_id, $id, $content) {
			global $config;
			$fcontent = $content;

			if (get_field_type($field_id) == "image") {
				unlink($config["uploads"] . "/" . $fcontent[$id]);
			}

			unset($fcontent[$id]);

			edit_content($field_id, $fcontent);
		}

		/* ---------------------------------
		------------- WORDINGS -------------
		--------------------------------- */
		function get_wordings() {
			global $db;

			$req = "SELECT * FROM wordings ORDER BY wording_id ASC";
			$res = mysqli_query($db, $req);
			$res = mysqli_fetch_all($res, MYSQLI_ASSOC);

			return $res;
		}

		/* ---------------------------------
		-------------- WORDING -------------
		--------------------------------- */
		function get_wording_errors($title, $content) {
			if ($title == "") {
				$msg_title = "Le titre ne peut pas être vide !";
			} else if (strlen($title) > 50) {
				$msg_title = "Le titre ne peut pas excéder 50 caractères !";
			} else if (!preg_match("#^[\w\s-]{1,50}$#u", $title)) {
				$msg_title = "Le titre ne peut contenir que des caractères alphabétiques, des tirets (-), des tirets bas (_) et des espaces !";
			}

			if ($content == "") {
				$msg_content = "Le contenu ne peut pas être vide !";
			} else if (strlen($content) > 4294967295) {
				$msg_content = "Le contenu ne peut pas excéder 4 294 967 295 caractères (4 Go) !";
			}

			$errors = array(
				"title" => array(
					"valid" => !isset($msg_title),
					"message" => (!isset($msg_title)) ?: $msg_title
				),
				"content" => array(
					"valid" => !isset($msg_content),
					"message" => (!isset($msg_content)) ?: $msg_content
				)
			);

			return $errors;
		}

		function check_wording_id($id) {
			global $db;

			$req = "SELECT * FROM wordings WHERE wording_id = ?";
			$stmt = mysqli_prepare($db, $req);
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);

			if (mysqli_stmt_num_rows($stmt) > 0) {
				$res = true;
			} else {
				$res = false;
			}

			mysqli_stmt_close($stmt);

			return $res;
		}

		function get_wording($id) {
			global $db;

			$req = "SELECT wording_title, wording_content FROM wordings WHERE wording_id = ?";
			$stmt = mysqli_prepare($db, $req);
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $title, $content);

			mysqli_stmt_fetch($stmt);

			$res = array(
				"title" => $title,
				"content" => $content
			);

			mysqli_stmt_close($stmt);

			return $res;
		}

		function get_field_data($field) {
			global $config, $settings;
			$content = unserialize($field["field_content"]);

			if (!count($content) > 0) {
				$res = '<a href="' . $config["sitelink"] . "/field/edit/" . $field["field_id"] . '" target="_blank">' . $settings["delimiter"] . "VEUILLEZ AJOUTER DES DONNEES AU CHAMP <strong>" . $field["field_code"] . "</strong>" . $settings["delimiter"] . "</a>";
			} else if ($field["field_type"] == "number") {
				$nb = intval(($content["higher"] - $content["lower"]) / $content["increase"]);
				$res = $content["lower"] + rand(0, $nb) * $content["increase"];
			} else if ($field["field_type"] == "text") {
				$rand = array_rand($content);
				$res = $content[$rand];
			} else if ($field["field_type"] == "image") {
				$rand = array_rand($content);
				$res = '<img src="' . $config["sitelink"] . "/" . $config["uploads"] . "/" . $content[$rand] . '" alt="' . $field["field_code"] . '" />';
			} else {
				$res = $settings["delimiter"] . "LE TYPE DU CHAMP <strong>" . $field["field_code"] . "</strong> EST INCORRECT" . $settings["delimiter"];
			}

			return $res;
		}

		function add_wording($title, $content) {
			global $db;

			$req = "INSERT INTO wordings (wording_title, wording_content) VALUES (?, ?)";
			$stmt = mysqli_prepare($db, $req);
			mysqli_stmt_bind_param($stmt, "ss", $title, $content);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		function edit_wording($id, $title, $content) {
			global $db;

			$req = "UPDATE wordings SET wording_title = ?, wording_content = ? WHERE wording_id = ?";
			$stmt = mysqli_prepare($db, $req);
			mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		function generate_wording($content) {
			global $db, $settings;
			$generate = htmlspecialchars_decode($content, ENT_QUOTES);
			$fields = get_fields();

			foreach ($fields as $field) {
				$code = $settings["delimiter"] . $field["field_code"] . $settings["delimiter"];
				$count = substr_count($generate, $code);
				$preg = "/" . $code . "/";

				for ($i = 0; $i < $count; $i++) {
					$generate = preg_replace($preg, get_field_data($field), $generate, 1);
				}
			}

			$preg = "/" . $settings["delimiter"] . "[a-z0-9_]+" . $settings["delimiter"] . "/";
			preg_match_all($preg, $generate, $matches);
			$matches = array_unique($matches[0]);

			foreach ($matches as $match) {
				$code = substr($match, 2, -2);
				$generate = str_replace($match, $settings["delimiter"] . "LE CHAMP <strong>" . $code . "</strong> N'EXISTE PAS" . $settings["delimiter"], $generate);
			}

			return $generate;
		}

		function delete_wording($id) {
			global $db;

			$req = "DELETE FROM wordings WHERE wording_id = ?";
			$stmt = mysqli_prepare($db, $req);
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		/* ---------------------------------
		------------- SETTINGS -------------
		--------------------------------- */
		function get_settings_errors($data) {
			$errors = array();

			foreach ($data as $key => $value) {
				$msg_data = NULL;

				if ($value == "") {
					$msg_data = "Le contenu du champ ne peut pas être vide !";
				} else if (strlen($value) > 255) {
					$msg_data = "Le contenu du champ ne peut pas excéder 255 caractères !";
				} else if ($key == "keywords" && !preg_match("#^[\w\s,]{1,255}$#u", $value)) {
					$msg_data = "Le contenu du champ ne peut contenir que des caractères alphabétiques, des tirets bas (_), des virgules (,) et des espaces !";
				} else if ($key == "delimiter" && !preg_match("#^[@\#!%]{1,255}$#", $value)) {
					$msg_data = "Le délimiteur ne peut contenir que les caractères @, #, ! et %";
				} else if ($key == "theme" && $value != "light" && $value != "dark") {
					$msg_data = "Le thème est incorrect !";
				}

				$errors[$key] = array(
					"valid" => !isset($msg_data),
					"message" => (!isset($msg_data)) ?: $msg_data
				);
			}

			return $errors;
		}

		function edit_settings($data) {
			global $db;

			foreach ($data as $key => $value) {
				$req = "UPDATE settings SET setting_value = ? WHERE setting_key = ?";
				$stmt = mysqli_prepare($db, $req);
				mysqli_stmt_bind_param($stmt, "ss", $value, $key);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}
		}
