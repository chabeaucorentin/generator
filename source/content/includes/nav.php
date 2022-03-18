<div class="hor-header header">
					<div class="container">
						<div class="d-flex align-items-center">
							<a class="header-brand" href="<?php echo $config["sitelink"]; ?>/">
								<img class="header-brand-img mobile-icon" src="<?php echo $config["sitelink"]; ?>/assets/images/brand/logo-dark.png" alt="<?php echo $settings["name"]; ?>" />
								<img class="header-brand-img desktop-logo mobile-logo" src="<?php echo $config["sitelink"]; ?>/assets/images/brand/logo-light.png" alt="<?php echo $settings["name"]; ?>" />
							</a>
							<div class="ml-auto header-right-icons">
								<?php
									if (isset($action) && $action == "generate") {
								?>
								<a class="btn btn-outline-default btn-icon" href="<?php echo $config["sitelink"] . "/wording/edit/" . $id; ?>" target="_blank">
									<span>
										<svg class="hor-icon mr-1" enable-background="new 0 0 186 186" viewBox="0 0 186 186" xmlns="http://www.w3.org/2000/svg" height="24" width="20">
											<path d="M186,24.333C186,10.894,175.106,0,161.667,0H24.333C10.894,0,0,10.894,0,24.333v137.333C0,175.106,10.894,186,24.333,186h137.333C175.106,186,186,175.106,186,161.667V24.333z M41.751,151.882c-4.03,1.081-7.718-2.607-6.637-6.637l6.683-24.91l24.863,24.863L41.751,151.882z M149.126,61.293l-73.584,73.585l-24.749-24.749l73.584-73.584c3.49-3.49,9.147-3.49,12.637,0l12.112,12.112C152.615,52.146,152.615,57.803,149.126,61.293z" />
										</svg>
									</span>
									Modifier l'énoncé
								</a>
								<?php
									} else {
								?>
								<a class="btn btn-outline-default btn-icon" href="<?php echo $config["sitelink"]; ?>/settings">
									<span>
										<svg class="hor-icon mr-1" enable-background="new 0 0 24 24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="24" width="20">
											<path d="m22.683 9.394-1.88-.239c-.155-.477-.346-.937-.569-1.374l1.161-1.495c.47-.605.415-1.459-.122-1.979l-1.575-1.575c-.525-.542-1.379-.596-1.985-.127l-1.493 1.161c-.437-.223-.897-.414-1.375-.569l-.239-1.877c-.09-.753-.729-1.32-1.486-1.32h-2.24c-.757 0-1.396.567-1.486 1.317l-.239 1.88c-.478.155-.938.345-1.375.569l-1.494-1.161c-.604-.469-1.458-.415-1.979.122l-1.575 1.574c-.542.526-.597 1.38-.127 1.986l1.161 1.494c-.224.437-.414.897-.569 1.374l-1.877.239c-.753.09-1.32.729-1.32 1.486v2.24c0 .757.567 1.396 1.317 1.486l1.88.239c.155.477.346.937.569 1.374l-1.161 1.495c-.47.605-.415 1.459.122 1.979l1.575 1.575c.526.541 1.379.595 1.985.126l1.494-1.161c.437.224.897.415 1.374.569l.239 1.876c.09.755.729 1.322 1.486 1.322h2.24c.757 0 1.396-.567 1.486-1.317l.239-1.88c.477-.155.937-.346 1.374-.569l1.495 1.161c.605.47 1.459.415 1.979-.122l1.575-1.575c.542-.526.597-1.379.127-1.985l-1.161-1.494c.224-.437.415-.897.569-1.374l1.876-.239c.753-.09 1.32-.729 1.32-1.486v-2.24c.001-.757-.566-1.396-1.316-1.486zm-10.683 7.606c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z" />
										</svg>
									</span>
									Paramètres
								</a>
								<?php
									}
								?>
							</div>
						</div>
					</div>
				</div>
