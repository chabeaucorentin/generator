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
									<li class="breadcrumb-item"><a href="<?php echo $config["sitelink"]; ?>/fields">Champs aléatoires</a></li>
									<?php
										if ($action == "add" && isset($type)) {
									?>
									<li class="breadcrumb-item"><a href="<?php echo $config["sitelink"]; ?>/field/add"><?php echo $page["breadcrumb"]; ?></a></li>
									<li class="breadcrumb-item active" aria-current="page"><?php echo $types[$type]; ?></li>
									<?php
										} else {
									?>
									<li class="breadcrumb-item active" aria-current="page"><?php echo $page["breadcrumb"]; ?></li>
									<?php
										}
									?>
								</ol>
							</div>
							<div class="ml-auto pageheader-btn">
								<?php
									if ($action == "add" && isset($type)) {
								?>
								<a class="btn btn-primary btn-icon text-white" href="<?php echo $config["sitelink"]; ?>/field/add">
									<span>
										<i class="fe fe-arrow-left"></i>
									</span> Retour aux types de champ
								</a>
								<?php
									} else {
								?>
								<a class="btn btn-primary btn-icon text-white" href="<?php echo $config["sitelink"]; ?>/fields">
									<span>
										<i class="fe fe-arrow-left"></i>
									</span> Afficher les champs aléatoires
								</a>
								<?php
									}
								?>
							</div>
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
										if ($action == "add" && !isset($type)) {
									?>
									<div class="card-body">
										<div class="row">
											<div class="col-sm-6 col-lg-12">
												<div class="card bg-info">
													<a class="card-body text-white" href="<?php echo $config["sitelink"]; ?>/field/add/number">
														<div class="row">
															<div class="col-lg-3 text-center d-lg-flex align-items-lg-center">
																<img class="w-95" src="<?php echo $config["sitelink"]; ?>/assets/images/fields/number.png" alt="Nombre" />
															</div>
															<div class="col-lg-7 d-flex align-items-center mt-4 mt-lg-0">
																<div class="text-white">
																	<h2 class="mb-3">NOMBRE</h2>
																	<h3 class="font-weight-normal mb-0">Séléction d'un nombre aléatoire</h3>
																</div>
															</div>
															<div class="col-lg-2 d-none d-lg-flex justify-content-lg-center align-items-lg-center">
																<i class="fa fa-chevron-right text-white fs-30"></i>
															</div>
														</div>
													</a>
												</div>
											</div>
											<div class="col-sm-6 col-lg-12">
												<div class="card bg-primary">
													<a class="card-body text-white" href="<?php echo $config["sitelink"]; ?>/field/add/text">
														<div class="row">
															<div class="col-lg-3 text-center d-lg-flex align-items-lg-center">
																<img class="w-95" src="<?php echo $config["sitelink"]; ?>/assets/images/fields/text.png" alt="Texte" />
															</div>
															<div class="col-lg-7 d-flex align-items-center mt-4 mt-lg-0">
																<div class="text-white">
																	<h2 class="mb-3">TEXTE</h2>
																	<h3 class="font-weight-normal mb-0">Séléction d'un texte aléatoire</h3>
																</div>
															</div>
															<div class="col-lg-2 d-none d-lg-flex justify-content-lg-center align-items-lg-center">
																<i class="fa fa-chevron-right text-white fs-30"></i>
															</div>
														</div>
													</a>
												</div>
											</div>
											<div class="col-sm-6 col-lg-12">
												<div class="card bg-secondary mb-0">
													<a class="card-body text-white" href="<?php echo $config["sitelink"]; ?>/field/add/image">
														<div class="row">
															<div class="col-lg-3 text-center d-lg-flex align-items-lg-center">
																<img class="w-95" src="<?php echo $config["sitelink"]; ?>/assets/images/fields/image.png" alt="Image" />
															</div>
															<div class="col-lg-7 d-flex align-items-center mt-4 mt-lg-0">
																<div class="text-white">
																	<h2 class="mb-3">IMAGE</h2>
																	<h3 class="font-weight-normal mb-0">Séléction d'une image aléatoire</h3>
																</div>
															</div>
															<div class="col-lg-2 d-none d-lg-flex justify-content-lg-center align-items-lg-center">
																<i class="fa fa-chevron-right text-white fs-30"></i>
															</div>
														</div>
													</a>
												</div>
											</div>
										</div>
									</div>
									<?php
										} else {
									?>
									<form method="post" action="<?php echo $page["link"]; ?>">
										<div class="card-body p-4">
											<?php
												if (isset($check) && $check) {
											?>
											<div class="alert alert-success mb-2" role="alert">
												<span class="alert-inner--icon mr-2"><i class="fa fa-check"></i></span>
												<span class="alert-inner--text"><strong>Le champ a bien été mis à jour</strong></span>
											</div>
											<?php
												}
											?>
											<div class="form-group">
												<label for="code">Code du champ</label>
												<?php
													if (isset($errors) && !$errors["code"]["valid"]) {
												?>
												<div class="alert alert-danger" role="alert">
													<span class="alert-inner--icon mr-2"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong><?php echo $errors["code"]["message"]; ?></strong></span>
												</div>
												<?php
													}
												?>
												<input id="code" class="form-control<?php if (isset($errors) && !$errors["code"]["valid"]) { echo " is-invalid state-invalid"; } ?>" type="text" name="code" placeholder="Ex : <?php echo $page["placeholder"]; ?>"<?php if (isset($code)) { echo ' value="' . $code . '"'; } ?> />
											</div>
											<?php
												if ($type == "number") {
											?>
											<div class="form-group">
												<label for="lower">Borne inférieure</label>
												<?php
													if (isset($errors) && !$errors["lower"]["valid"]) {
												?>
												<div class="alert alert-danger" role="alert">
													<span class="alert-inner--icon mr-2"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong><?php echo $errors["lower"]["message"]; ?></strong></span>
												</div>
												<?php
													}
												?>
												<input id="lower" class="form-control<?php if (isset($errors) && !$errors["lower"]["valid"]) { echo " is-invalid state-invalid"; } ?>" type="number" name="lower" placeholder="Ex : 25"<?php if (isset($lower)) { echo ' value="' . $lower . '"'; } ?> />
											</div>
											<div class="form-group">
												<label for="higher">Borne supérieure</label>
												<?php
													if (isset($errors) && !$errors["higher"]["valid"]) {
												?>
												<div class="alert alert-danger" role="alert">
													<span class="alert-inner--icon mr-2"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong><?php echo $errors["higher"]["message"]; ?></strong></span>
												</div>
												<?php
													}
												?>
												<input id="higher" class="form-control<?php if (isset($errors) && !$errors["higher"]["valid"]) { echo " is-invalid state-invalid"; } ?>" type="number" name="higher" placeholder="Ex : 41"<?php if (isset($higher)) { echo ' value="' . $higher . '"'; } ?> />
											</div>
											<div class="form-group">
												<label for="increase">Pas</label>
												<?php
													if (isset($errors) && !$errors["increase"]["valid"]) {
												?>
												<div class="alert alert-danger" role="alert">
													<span class="alert-inner--icon mr-2"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong><?php echo $errors["increase"]["message"]; ?></strong></span>
												</div>
												<?php
													}
												?>
												<input id="increase" class="form-control<?php if (isset($errors) && !$errors["increase"]["valid"]) { echo " is-invalid state-invalid"; } ?>" type="number" step="0.01" name="increase" placeholder="Ex : 0.1"<?php if (isset($increase)) { echo ' value="' . $increase . '"'; } ?> />
											</div>
											<?php
												}
											?>
										</div>
										<div class="card-footer text-right">
											<input class="btn btn-primary" type="submit" value="<?php echo $page["btn_text"]; ?>" />
										</div>
									</form>
									<?php
										}
									?>
								</div>
							</div>
						</div>
						<!-- END CARD -->

						<?php
							if ($action == "edit" && $type != "number") {
						?>
						<!-- LIST -->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"><?php echo $subfields["card_title"]; ?></h3>
										<div class="card-options">
											<a class="btn btn-primary btn-icon text-white d-none d-sm-inline-block" href="<?php echo $config["sitelink"] . "/subfield/" . $id . "/add"; ?>">
												<span>
													<i class="fe fe-plus"></i>
												</span> <?php echo $subfields["btn_text"]; ?>
											</a>
											<a class="btn btn-primary btn-icon text-white d-sm-none" href="<?php echo $config["sitelink"] . "/subfield/" . $id . "/add"; ?>">
												<span>
													<i class="fe fe-plus"></i>
												</span>
											</a>
										</div>
									</div>
									<div class="card-body p-4">
										<div class="table-responsive service">
											<table class="table table-bordered table-hover mb-0 text-nowrap">
												<?php
													if (count($content) > 0) {
												?>
												<thead>
													<tr>
														<th><?php echo $subfields["table_id"]; ?></th>
														<th class="w-100"><?php echo $types[$type]; ?></th>
														<th>Action</th>
													</tr>
												</thead>
												<?php
													}
												?>
												<tbody>
													<?php
														if (count($content) > 0) {
															foreach ($content as $key => $value) {
													?>
													<tr>
														<td><?php echo $key + 1; ?></td>
														<td>
															<?php
																if ($type == "image") {
																	echo '<img class="mh-15" src="' . $config["sitelink"] . "/" . $config["uploads"] . "/" . $value . '" alt="' . $code . '" />';
																} else {
																	echo $value;
																}
															?>
														</td>
														<td>
															<a class="btn btn-primary btn-sm text-white" data-original-title="Modifier" data-toggle="tooltip" href="<?php echo $config["sitelink"] . "/subfield/" . $id . "/edit/" . ($key + 1); ?>"><i class="fa fa-pencil"></i></a> <span data-toggle="modal" data-target="#modal<?php echo $key + 1; ?>"><button class="btn btn-danger btn-sm text-white" type="button" data-original-title="Supprimer" data-toggle="tooltip"><i class="fa fa-trash-o"></i></button></span><br>
														</td>
													</tr>
													<?php
															}
														} else {
													?>
													<tr>
														<td colspan="2" class="text-center">Aucune données</td>
													</tr>
													<?php
														}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END LIST -->
						<?php
							}
						?>
					</div>
				</div>
				<!-- END CONTENT AREA -->

				<!-- MODALS -->
				<?php
					if ($action == "edit" && $type != "number") {
						foreach ($content as $key => $value) {
				?>
				<div id="modal<?php echo $key + 1; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal<?php echo $key + 1; ?>label" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modal<?php echo $key + 1; ?>label"><?php echo $subfields["modal_title"]; ?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<?php
									if ($type == "image") {
										echo "<p>Êtes-vous sûr de vouloir supprimer l'image ?</p>";
										echo '<img src="' . $config["sitelink"] . "/" . $config["uploads"] . "/" . $value . '" alt="' . $code . '" />';
									} else {
										echo '<p>Êtes-vous sûr de vouloir supprimer le texte "' . $value . '" ?</p>';
									}
								?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
								<a class="btn btn-danger" href="<?php echo $config["sitelink"] . "/subfield/" . $id . "/delete/" . ($key + 1); ?>">Supprimer</a>
							</div>
						</div>
					</div>
				</div>
				<?php
						}
					}
				?>
				<!-- END MODALS -->
			</div>

			<!-- FOOTER -->
			<?php include("content/includes/footer.php"); ?>
			<!-- END FOOTER -->
		</div>

		<?php include("content/includes/scripts.php"); ?>
	</body>
</html>
