<?php if (isset($reply['valid'])) { ?>
	<div class="row reply">
		<div class="alert alert-success alert-block">
			<a class="close" data-dismiss="alert" href="#">×</a>
			<h4 class="alert-heading">Success!</h4>
			<?=$reply['valid']?>
			<? if (isset($error_file)) { ?>
				<a href="<?=(F_URL.'user_data/'.$error_file)?>" class="alert-danger">
					Danh sách dữ liệu bị lỗi
				</a>
			<? } ?>
		</div>
	</div>
<?php } ?>

<?php if (isset($reply['invalid'])) { ?>
	<div class="row reply">
		<div class="alert alert-danger alert-block">
			<a class="close" data-dismiss="alert" href="#">×</a>
			<h4 class="alert-heading">Error!</h4>
			<?=$reply['invalid']?>
		</div>
	</div>
<?php } ?>