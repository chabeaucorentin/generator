<?php include("content/includes/copyrights.php"); ?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php
			include("content/includes/head.php");

			if ($action == "add" || $action == "edit") {
		?>
		<!-- TRIX CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo $config["sitelink"]; ?>/assets/plugins/trix/css/trix.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $config["sitelink"]; ?>/assets/css/editor.css" />
		<?php
			} else {
		?>
		<!-- GENERATE CSS -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo $config["sitelink"]; ?>/assets/css/generate.css" />
		<?php
			}
		?>
	</head>

	<body<?php if ($settings["theme"] == "dark") { echo ' class="dark-mode"'; } ?>>
		<?php
			if ($action != "generate") {
		?>
		<!-- LOADER -->
		<div id="global-loader">
			<img class="loader-img" src="<?php echo $config["sitelink"]; ?>/assets/images/loader.svg" alt="Loader" />
		</div>
		<!-- END LOADER -->
		<?php
			}
		?>

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
						<div class="page-header<?php if ($action == "generate") { echo " min-h-0"; } ?>">
							<div>
								<h1 class="<?php if ($action == "generate") { echo "mb-0"; } else { echo "page-title"; } ?>"><?php echo $page["title"]; ?></h1>
								<?php
									if ($action == "add" || $action == "edit") {
								?>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo $config["sitelink"]; ?>/">Tableau de bord</a></li>
									<li class="breadcrumb-item"><a href="<?php echo $config["sitelink"]; ?>/wordings">Énoncés</a></li>
									<li class="breadcrumb-item active" aria-current="page"><?php echo $page["breadcrumb"]; ?></li>
								</ol>
								<?php
									}
								?>
							</div>
							<?php
								if ($action == "add" || $action == "edit") {
							?>
							<div class="ml-auto pageheader-btn">
								<a class="btn btn-primary btn-icon text-white" href="<?php echo $config["sitelink"]; ?>/wordings">
									<span>
										<i class="fe fe-arrow-left"></i>
									</span> Afficher les énoncés
								</a>
							</div>
							<?php
								}
							?>
						</div>
						<!-- END CONTENT HEADER -->

						<!-- CARD -->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title"><?php echo $page["card_title"]; ?></div>
									</div>
									<?php
										if ($action == "add" || $action == "edit") {
									?>
									<form method="post" action="<?php echo $page["link"]; ?>">
										<div class="card-body p-4">
											<?php
												if (isset($check) && $check) {
											?>
											<div class="alert alert-success mb-2" role="alert">
												<span class="alert-inner--icon mr-2"><i class="fa fa-check"></i></span>
												<span class="alert-inner--text"><strong>L'énoncé a bien été mis à jour</strong></span>
											</div>
											<?php
												}
											?>
											<div class="form-group has-danger">
												<label for="title">Titre de l'énoncé</label>
												<?php
													if (isset($errors) && !$errors["title"]["valid"]) {
												?>
												<div class="alert alert-danger" role="alert">
													<span class="alert-inner--icon mr-2"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong><?php echo $errors["title"]["message"]; ?></strong></span>
												</div>
												<?php
													}
												?>
												<input id="title" class="form-control<?php if (isset($errors) && !$errors["title"]["valid"]) { echo " is-invalid state-invalid"; } ?>" type="text" name="title" placeholder="Ex : PHP - Exercice 1"<?php if (isset($title)) { echo ' value="' . $title . '"'; } ?> />
											</div>
											<div class="form-group">
												<label for="editor">Consignes de l'énoncé</label>
												<div class="row">
													<div class="col-12">
														<div class="card card-collapsed text-white bg-primary mb-4">
															<a class="card-header card-options-collapse text-white pl-4" data-toggle="card-collapse" href="#">
																<h4 class="card-title">Champs aléatoires</h4>
																<div class="card-options">
																	<i class="fe fe-chevron-up text-white"></i>
																</div>
															</a>
															<div class="card-body p-4">
																<h1>Insertion de champs aléatoires</h1>
																<p class="lead">Personnalisez votre énoncé en ajoutant des champs aléatoires, ceux-ci sont automatiquement remplacé lors de la génération du contenu.</p>
																<hr class="my-4" />
																<p class="lead">Syntaxe :</p>
																<p class="lead"><strong><?php echo $settings["delimiter"]; ?>code_du_champ<?php echo $settings["delimiter"]; ?></strong></p>
																<hr class="my-4" />
																<p class="lead">Exemple d'utilisation :</p>
																<p class="lead">Le champ <strong>nom</strong>, de type texte, possède les valeurs suivantes :</p>
																<div class="table-responsive service">
																	<table class="table table-bordered table-hover text-nowrap text-white">
																		<tbody>
																			<tr>
																				<td>Dupond</td>
																			</tr>
																			<tr>
																				<td>Durand</td>
																			</tr>
																			<tr>
																				<td>Sagot</td>
																			</tr>
																			<tr>
																				<td>Thiernesse</td>
																			</tr>
																		</tbody>
																	</table>
																</div>
																<p class="lead">Le champ peut ici être appellé en utilisant la syntaxe <strong><?php echo $settings["delimiter"]; ?>nom<?php echo $settings["delimiter"]; ?></strong> qui remplacera le texte par l'une des valeurs ci-dessus.</p>
															</div>
															<div class="card-footer bg-primary pl-4"> <!-- text-left text-sm-right -->
																<a class="btn btn-white btn-icon btn-lg d-none d-md-inline-block mr-2" href="<?php echo $config["sitelink"]; ?>/fields" target="_blank">
																	<span>
																		<i class="fe fe-eye"></i>
																	</span> Afficher les champs aléatoires
																</a>
																<a class="btn btn-white btn-icon btn-lg d-none d-sm-inline-block d-md-none mr-2" href="<?php echo $config["sitelink"]; ?>/fields" target="_blank">
																	<span>
																		<i class="fe fe-eye"></i>
																	</span> Afficher
																</a>
																<a class="btn btn-white btn-icon btn-lg d-sm-none mr-2" href="<?php echo $config["sitelink"]; ?>/fields" target="_blank">
																	<span>
																		<i class="fe fe-eye"></i>
																	</span>
																</a>
																<a class="btn btn-dark btn-icon text-white btn-lg d-none d-md-inline-block" href="<?php echo $config["sitelink"]; ?>/field/add" target="_blank">
																	<span>
																		<i class="fe fe-plus"></i>
																	</span> Ajouter un champ aléatoire
																</a>
																<a class="btn btn-dark btn-icon text-white btn-lg d-none d-sm-inline-block d-md-none" href="<?php echo $config["sitelink"]; ?>/field/add" target="_blank">
																	<span>
																		<i class="fe fe-plus"></i>
																	</span> Ajouter
																</a>
																<a class="btn btn-dark btn-icon text-white btn-lg d-sm-none" href="<?php echo $config["sitelink"]; ?>/field/add" target="_blank">
																	<span>
																		<i class="fe fe-plus"></i>
																	</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<?php
													if (isset($errors) && !$errors["content"]["valid"]) {
												?>
												<div class="alert alert-danger" role="alert">
													<span class="alert-inner--icon mr-2"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong><?php echo $errors["content"]["message"]; ?></strong></span>
												</div>
												<?php
													}
												?>
												<input id="editor" type="hidden" name="content"<?php if (isset($content)) { echo ' value="' . $content . '"'; } ?> />
												<trix-editor class="trix-content" input="editor"></trix-editor>
											</div>
										</div>
										<div class="card-footer text-right">
											<input class="btn btn-primary" type="submit" value="<?php echo $page["btn_text"]; ?>" />
										</div>
									</form>
									<?php
										} else {
									?>
									<div class="card-body generate">
										<?php echo $content; ?>
									</div>
									<?php
										}
									?>
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
			if ($action != "generate") {
				include("content/includes/scripts.php");
		?>
		<!--TRIX -->
		<script src="<?php echo $config["sitelink"]; ?>/assets/plugins/trix/js/trix.js"></script>
		<?php
			}
		?>
	</body>
</html>
