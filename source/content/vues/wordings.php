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
									<li class="breadcrumb-item active" aria-current="page">Énoncés</li>
								</ol>
							</div>
							<div class="ml-auto pageheader-btn">
								<a class="btn btn-primary btn-icon text-white" href="<?php echo $config["sitelink"]; ?>/wording/add">
									<span>
										<i class="fe fe-plus"></i>
									</span> Ajouter un énoncé
								</a>
							</div>
						</div>
						<!-- END CONTENT HEADER -->

						<!-- CARD -->
						<div class="row">
							<div class="col-12">
								<div class="card banner">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-3 text-center d-lg-flex align-items-lg-center mb-3 mb-lg-0">
												<img class="w-95" src="<?php echo $config["sitelink"]; ?>/assets/images/header/<?php echo $header["image"]; ?>" alt="<?php echo $header["title"]; ?>" />
											</div>
											<div class="col-lg-9 pl-lg-0">
												<div class="row">
													<div class="col-lg-7 d-flex align-items-center">
														<div class="text-white">
															<h3 class="font-weight-semibold"><?php echo $header["title"]; ?></h3>
															<h4 class="font-weight-normal mb-0"><?php echo $header["desc"]; ?></h4>
														</div>
													</div>
													<div class="col-lg-5 text-lg-center mt-xl-4 mb-xl-4">
														<h5 class="font-weight-semibold mb-1 text-white mt-4 mt-lg-0"><?php echo $header["nb_text"]; ?></h5>
														<h2 class="display-2 mb-3 number-font text-white"><?php echo $header["nb"]; ?></h2>
														<div class="btn-list mb-xl-0 text-center">
															<a class="btn btn-white mb-xl-0" href="<?php echo $config["sitelink"]; ?>/wording/add"><?php echo $header["btn_text"]; ?></a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END CARD -->

						<!-- LIST -->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Liste des énoncés</h3>
										<div class="card-options">
											<a class="btn btn-primary btn-icon text-white d-none d-sm-inline-block" href="<?php echo $config["sitelink"]; ?>/wording/add">
												<span>
													<i class="fe fe-plus"></i>
												</span> Ajouter un énoncé
											</a>
											<a class="btn btn-primary btn-icon text-white d-sm-none" href="<?php echo $config["sitelink"]; ?>/wording/add">
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
													if ($nb_wordings > 0) {
												?>
												<thead>
													<tr>
														<th>ID de l'énoncé</th>
														<th class="w-100">Titre</th>
														<th>Date de création</th>
														<th>Action</th>
													</tr>
												</thead>
												<?php
													}
												?>
												<tbody>
													<?php
														if ($nb_wordings > 0) {
															foreach ($wordings as $wording) {
													?>
													<tr>
														<td><?php echo $wording["wording_id"]; ?></td>
														<td><?php echo $wording["wording_title"]; ?></td>
														<td><?php echo date("d/m/Y à H\hi", strtotime($wording["wording_date"])); ?></td>
														<td>
															<a class="btn btn-primary btn-sm text-white" data-original-title="Modifier" data-toggle="tooltip" href="<?php echo $config["sitelink"] . "/wording/edit/" . $wording["wording_id"]; ?>"><i class="fa fa-pencil"></i></a> <a class="btn btn-info btn-sm text-white" data-original-title="Générer" data-toggle="tooltip" href="<?php echo $config["sitelink"] . "/wording/generate/" . $wording["wording_id"]; ?>"><i class="fa fa-download"></i></a> <span data-toggle="modal" data-target="#modal<?php echo $wording["wording_id"]; ?>"><button class="btn btn-danger btn-sm text-white" type="button" data-original-title="Supprimer" data-toggle="tooltip"><i class="fa fa-trash-o"></i></button></span><br>
														</td>
													</tr>
													<?php
															}
														} else {
													?>
													<tr>
														<td colspan="4" class="text-center">Aucune données</td>
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
					</div>
				</div>
				<!-- END CONTENT AREA -->

				<!-- MODALS -->
				<?php
					foreach ($wordings as $wording) {
				?>
				<div id="modal<?php echo $wording["wording_id"]; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal<?php echo $wording["wording_id"]; ?>label" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modal<?php echo $wording["wording_id"]; ?>label">Suppression d'un énoncé</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Êtes-vous sûr de vouloir supprimer l'énoncé "<?php echo $wording["wording_title"]; ?>" ?</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
								<a class="btn btn-danger" href="<?php echo $config["sitelink"] . "/wording/delete/" . $wording["wording_id"]; ?>">Supprimer</a>
							</div>
						</div>
					</div>
				</div>
				<?php
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
