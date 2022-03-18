<?php
	$config = array(
		/* ---------------------------------
		-------------- CONFIG --------------
		--------------------------------- */
		"sitelink" => "http://192.168.0.181/generator",
		"uploads" => "content/uploads",

		/* ---------------------------------
		------------- DATABASE -------------
		--------------------------------- */
		"dbname" => "generator",
		"dbuser" => "root",
		"dbpassword" => "root",
		"dbhost" => "localhost"
	);

	$db = mysqli_connect($config["dbhost"], $config["dbuser"], $config["dbpassword"], $config["dbname"]);

	if (mysqli_connect_errno()) {
		echo "Erreur lors de la connexion à MySQL : " . mysqli_connect_error();
		exit();
	}

	mysqli_set_charset($db, "utf8");

	/* ---------------------------------
	------------- FUNCTIONS ------------
	--------------------------------- */
	function get_settings() {
		global $db;

		$req = "SELECT setting_key, setting_value FROM settings";
		$res = mysqli_query($db, $req);
		$res = mysqli_fetch_all($res, MYSQLI_ASSOC);
		$res = array_column($res, "setting_value", "setting_key");

		return $res;
	}

	$settings = get_settings();
	$activePage = basename($_SERVER['PHP_SELF'], ".php");
