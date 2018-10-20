<!--#HEADER -->
<header id="header">

	<!-- #PROJECTS: projects dropdown -->
	<div class="project-context hidden-xs">
		<span class="label">Projects:</span>
		<span class="project-selector">
			<a href="<?=F_URL ?>" target="_blank"><?=$project['name'] ?></a>
		</span>
	</div>
	<!-- end projects dropdown -->

	<!-- #TOGGLE LAYOUT BUTTONS -->
	<!-- pulled right: nav area -->
	<div class="pull-right">
		
		<!-- account button -->
			<div id="account" class="btn-header transparent pull-right">
				<span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<a href="#" class="userdropdown"> 
						<?php if ($authMember['thumbnail'] == "") { ?>
						<img src="/upload/images/member/avatar.png" />
						<?php } else { ?>
						<img src="<?=$authMember['thumbnail'] ?>" />
						<?php } ?>
					</a>
					<?=$authMember['username']?>
				</span>
				<ul class="dropdown-menu pull-right">
					<li>
						<a href="<?=B_URL?>member/profile" class="padding-10 padding-top-0 padding-bottom-0"> 
							<i class="fa fa-user"></i> <u>P</u>rofile
						</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="<?=B_URL?>auth/logout" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
					</li>
				</ul>
			</div>
			
		<!-- fullscreen button -->
			<div id="fullscreen" class="btn-header transparent pull-right">
				<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
			</div>
		<!-- end fullscreen button -->
		
		<!-- end logout button -->

		<!-- document button -->
			<!--<div id="document" class="btn-header transparent pull-right">
				<span> <a href="<?/*=F_URL*/?>backend/document" title="View Document" target="_blank"><i class="fa fa-book"></i></a> </span>
			</div>-->
		<!-- end document button -->

		<!-- frontend button -->
			<div id="frontend" class="btn-header transparent pull-right">
				<span> <a href="<?=F_URL?>" title="View Frontend" target="_blank"><i class="fa fa-home"></i></a> </span>
			</div>
		<!-- end frontend button -->

		
		<!-- end account button -->
	</div>
	<!-- end pulled right: nav area -->
</header>
<!-- END HEADER