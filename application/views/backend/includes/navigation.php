<!-- #NAVIGATION -->
	<!-- Left panel : Navigation area -->
	<!-- Note: This width of the aside area can be adjusted through LESS variables -->
	<aside id="left-panel">

		<!-- User info -->
		<div class="login-info">
			<span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
				<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
					<i class="fa fa-user" style="font-size: 20px; margin-top: 3px;"></i>
					<span style="padding-left: 10px; line-height: 18px;"><?=$authMember['username']?></span>
				</a> 
			</span>
		</div>
		<!-- end user info -->

		<!-- NAVIGATION : This navigation is also responsive-->
		<nav>
			<ul>
				<?php 
				foreach ($modules as $module) {
					if ($permissionsMember[$module['url']][1] == 1) {
						if (isset($activeNav) && $activeNav == $module['url']) {
							if ($module['id'] != 1 && $module['id'] < 6) { ?>
								<li class="moduleDefault active">
							<?php } else { ?>
								<li class="active">
							<?php }
							$activeModuleIcon = $module['icon'];
						}
						else {
							if ($module['id'] != 1 && $module['id'] < 6) { ?>
								<li class="moduleDefault">
							<?php } else { ?>
								<li>
							<?php }
						} ?>
							<a href="<?=B_URL.$module['url']?>">
								<i class="<?=$module['icon']?>"></i> 
								<span class="menu-item-parent"><?=$module['name']?></span>
							</a>
						</li>
					<?php }
				}
				?>
			</ul>
		</nav>
		<span class="minifyme" data-action="minifyMenu"> 
			<i class="fa fa-arrow-circle-left hit"></i> 
		</span>
	</aside>
<!-- END NAVIGATION -->
