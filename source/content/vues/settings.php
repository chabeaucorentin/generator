<?php include("content/includes/copyrights.php"); ?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php include("content/includes/head.php"); ?>
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
									<li class="breadcrumb-item active" aria-current="page">Paramètres</li>
								</ol>
							</div>
							<div class="ml-auto pageheader-btn">
								<a class="btn btn-primary btn-icon text-white" href="<?php echo $config["sitelink"]; ?>/">
									<span>
										<i class="fe fe-arrow-left"></i>
									</span> Retour au tableau de bord
								</a>
							</div>
						</div>
						<!-- END CONTENT HEADER -->

						<!-- LIST -->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Liste des paramètres</div>
									</div>
									<form method="post" action="<?php echo $page["link"]; ?>">
										<div class="card-body p-4">
											<?php
												if (isset($check) && $check) {
											?>
											<div class="alert alert-success mb-2" role="alert">
												<span class="alert-inner--icon mr-2"><i class="fa fa-check"></i></span>
												<span class="alert-inner--text"><strong>Les paramètres ont bien été mises à jour</strong></span>
											</div>
											<?php
												}
											?>
											<div class="form-group">
												<label for="name">Nom du site</label>
												<?php
													if (isset($errors) && !$errors["name"]["valid"]) {
												?>
												<div class="alert alert-danger" role="alert">
													<span class="alert-inner--icon mr-2"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong><?php echo $errors["name"]["message"]; ?></strong></span>
												</div>
												<?php
													}
												?>
												<input id="name" class="form-control<?php if (isset($errors) && !$errors["name"]["valid"]) { echo " is-invalid state-invalid"; } ?>" type="text" name="name" value="<?php echo $name; ?>" />
											</div>
											<div class="form-group">
												<label for="description">Description</label>
												<?php
													if (isset($errors) && !$errors["description"]["valid"]) {
												?>
												<div class="alert alert-danger" role="alert">
													<span class="alert-inner--icon mr-2"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong><?php echo $errors["description"]["message"]; ?></strong></span>
												</div>
												<?php
													}
												?>
												<input id="description" class="form-control<?php if (isset($errors) && !$errors["description"]["valid"]) { echo " is-invalid state-invalid"; } ?>" type="texte" name="description" value="<?php echo $description; ?>" />
											</div>
											<div class="form-group">
												<label for="keywords">Mots-clés (séparer avec des <strong>,</strong>)</label>
												<?php
													if (isset($errors) && !$errors["keywords"]["valid"]) {
												?>
												<div class="alert alert-danger" role="alert">
													<span class="alert-inner--icon mr-2"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong><?php echo $errors["keywords"]["message"]; ?></strong></span>
												</div>
												<?php
													}
												?>
												<input id="keywords" class="form-control<?php if (isset($errors) && !$errors["keywords"]["valid"]) { echo " is-invalid state-invalid"; } ?>" type="texte" name="keywords" value="<?php echo $keywords; ?>" />
											</div>
											<div class="form-group">
												<label for="delimiter">Délimiteur</label>
												<?php
													if (isset($errors) && !$errors["delimiter"]["valid"]) {
												?>
												<div class="alert alert-danger" role="alert">
													<span class="alert-inner--icon mr-2"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong><?php echo $errors["delimiter"]["message"]; ?></strong></span>
												</div>
												<?php
													}
												?>
												<input id="delimiter" class="form-control<?php if (isset($errors) && !$errors["delimiter"]["valid"]) { echo " is-invalid state-invalid"; } ?>" type="text" name="delimiter" value="<?php echo $delimiter; ?>" />
											</div>
											<div class="form-group">
												<label for="design">Thème</label>
												<?php
													if (isset($errors) && !$errors["theme"]["valid"]) {
												?>
												<div class="alert alert-danger" role="alert">
													<span class="alert-inner--icon mr-2"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong><?php echo $errors["theme"]["message"]; ?></strong></span>
												</div>
												<?php
													}
												?>
												<div class="row">
													<div class="col-12 col-sm-6 btn-theme">
														<input id="light" class="input-label d-none" type="radio" name="design" value="light"<?php if ($theme == "light") { echo " checked"; } ?>>
														<label class="button-label" for="light">
															<div class="icon">
																<img src="<?php echo $config["sitelink"]; ?>/assets/images/theme/light.svg" />
															</div>
															<div class="title">Thème clair</div>
														</label>
													</div>
													<div class="col-12 col-sm-6 btn-theme">
														<input id="dark" class="input-label d-none" type="radio" name="design" value="dark"<?php if ($theme == "dark") { echo " checked"; } ?>>
														<label class="button-label" for="dark">
															<div class="icon">
																<img src="<?php echo $config["sitelink"]; ?>/assets/images/theme/dark.svg" />
															</div>
															<div class="title">Thème sombre</div>
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="card-footer text-right">
											<input class="btn btn-primary" type="submit" value="Modifier les paramètres" />
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- END LIST -->
					</div>
				</div>
				<!-- END CONTENT AREA -->
			</div>

			<!-- FOOTER -->
			<?php include("content/includes/footer.php"); ?>
			<!-- END FOOTER -->
		</div>

		<?php include("content/includes/scripts.php"); ?>
	</body>
</html>
