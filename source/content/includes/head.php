<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="author" content="COCO" />
		<meta name="description" content="<?php echo $settings["description"]; ?>" />
		<meta name="keywords" content="<?php echo $settings["keywords"]; ?>" />

		<!-- TITLE -->
		<title><?php echo $page["title"] . " | " . $settings["name"]; ?></title>

		<!-- FAVICON -->
		<link rel="apple-touch-icon" href="<?php echo $config["sitelink"]; ?>/assets/images/brand/apple-touch-icon.png" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $config["sitelink"]; ?>/assets/images/brand/favicon.ico" />
		<link rel="icon" href="<?php echo $config["sitelink"]; ?>/assets/images/brand/favicon.png" />

		<!-- OPEN GRAPH TAGS -->
		<meta property="og:title" content="<?php echo $page["title"] . " | " . $settings["name"]; ?>" />
		<meta property="og:description" content="<?php echo $settings["description"]; ?>" />
		<meta property="og:image" content="<?php echo $config["sitelink"]; ?>/assets/images/brand/og-image.png" />
		<meta property="og:url" content="<?php echo $page["link"]; ?>" />
		<meta name="twitter:card" content="summary_large_image" />

		<!-- BOOTSTRAP CSS -->
		<link rel="stylesheet" href="<?php echo $config["sitelink"]; ?>/assets/plugins/bootstrap/css/bootstrap.min.css" />

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="<?php echo $config["sitelink"]; ?>/assets/css/style.css" />
		<link rel="stylesheet" href="<?php echo $config["sitelink"]; ?>/assets/css/dark-style.css" />

		<!--- FONT-ICONS CSS -->
		<link rel="stylesheet" href="<?php echo $config["sitelink"]; ?>/assets/css/icons.css" />

		<!-- COLOR SKIN CSS -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo $config["sitelink"]; ?>/assets/css/colors.css" />
