<?php include("content/includes/copyrights.php"); ?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include("content/includes/head.php");

			if ($type == "image") {
		?>
		<!-- INTERNAL FILE UPLODE CSS -->
		<link href="<?php echo $config["sitelink"]; ?>/assets/plugins/fileuploads/css/fileupload.css" rel="stylesheet" type="text/css"/>
		<?php
			}
		?>
	</head>

	<body<?php if ($settings["theme"] == "dark") { echo ' class="dark-mode"'; } ?>>
		<!-- LOADER -->
		<div id="global-loader">
			<img class="loader-img" src="<?php echo $config["sitelink"]; ?>/assets/images/loader.svg" alt="Loader" />
		</div>
		<!-- END LOADER -->

		<!-- MAIN CONTENT -->
		<div class="page">
			<div class="page-main">
				<!-- NAVIGATION BAR -->
				<?php include("content/includes/nav.php"); ?>
				<!-- END NAVIGATION BAR -->

				<!-- CONTENT AREA -->
				<div class="content-area">
					<div class="container">
						<!-- CONTENT HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title"><?php echo $page["title"]; ?></h1>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo $config["sitelink"]; ?>/">Tableau de bord</a></li>
									<li class="breadcrumb-item"><a href="<?php echo $config["sitelink"]; ?>/fields">Champs aléatoires</a></li>
									<li class="breadcrumb-item"><a href="<?php echo $config["sitelink"] . "/field/edit/" . $field_id; ?>"><?php echo $types[$type]; ?></a></li>
									<li class="breadcrumb-item active" aria-current="page"><?php echo $page["breadcrumb"]; ?></li>
								</ol>
							</div>
							<div class="ml-auto pageheader-btn">
								<a class="btn btn-primary btn-icon text-white" href="<?php echo $config["sitelink"] . "/field/edit/" . $field_id; ?>">
									<span>
										<i class="fe fe-arrow-left"></i>
									</span> Retour à la modification du champ
								</a>
							</div>
						</div>
						<!-- END CONTENT HEADER -->

						<!-- CARD -->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Informations concernant le champ aléatoire</div>
									</div>
									<form enctype="multipart/form-data" method="post" action="<?php echo $page["link"]; ?>">
										<div class="card-body p-4">
											<div class="form-group">
												<label for="data"><?php echo $types[$type]; ?></label>
												<?php
													if (isset($errors) && !$errors["valid"]) {
												?>
												<div class="alert alert-danger" role="alert">
													<span class="alert-inner--icon mr-2"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong><?php echo $errors["message"]; ?></strong></span>
												</div>
												<?php
													}
													if ($type == "text") {
												?>
												<input id="data" class="form-control<?php if (isset($errors) && !$errors["valid"]) { echo " is-invalid state-invalid"; } ?>" type="text" name="text" placeholder="Ex : Charlie"<?php if (isset($data)) { echo ' value="' . $data . '"'; } ?> />
												<?php
													} else {
												?>
												<input id="data" class="dropify" type="file" data-max-file-size="2M"<?php if ($action == "edit") { echo ' data-default-file="' . $config["sitelink"] . "/" . $config["uploads"] . "/" . $data . '"'; } ?> name="file" />
												<?php
													}
												?>
											</div>
										</div>
										<div class="card-footer text-right">
											<input class="btn btn-primary" type="submit" value="<?php echo $page["btn_text"]; ?>" />
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- END CARD -->
					</div>
				</div>
				<!-- END CONTENT AREA -->
			</div>

			<!-- FOOTER -->
			<?php include("content/includes/footer.php"); ?>
			<!-- END FOOTER -->
		</div>

		<?php
			include("content/includes/scripts.php");

			if ($type == "image") {
		?>
		<!-- INTERNAL FILE UPLOADES JS -->
		<script src="<?php echo $config["sitelink"]; ?>/assets/plugins/fileuploads/js/fileupload.js"></script>
		<script src="<?php echo $config["sitelink"]; ?>/assets/plugins/fileuploads/js/file-upload.js"></script>
		<?php
			}
		?>
	</body>
</html>
