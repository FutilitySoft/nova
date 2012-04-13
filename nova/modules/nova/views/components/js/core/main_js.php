<?php include_once NOVAPATH.'nova/views/components/js/core/core_js.php';?>

<script type="text/javascript" src="<?php echo Uri::base(false);?>nova/modules/assets/js/jquery.jeditable.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		
		<?php if (Sentry::check() and Sentry::user()->has_access('content.update')): ?>

		$('.editable-single').editable("<?php echo Uri::create('ajax/update/content_save');?>", {
			loadurl: "<?php echo Uri::create('ajax/get/content_load');?>",
			id: 'key',
			cancel: false,
			submit: '<button class="btn btn-mini" type="submit">Save</button>',
			placeholder: ''
		});

		$('.editable-multi').editable("<?php echo Uri::create('ajax/update/content_save');?>", {
			loadurl: "<?php echo Uri::create('ajax/get/content_load');?>",
			id: 'key',
			type: 'textarea',
			cancel: false,
			submit: '<button class="btn btn-mini" type="submit">Save</button> <span class="muted">&nbsp;Press ESC to discard</span>',
			rows: 5,
			placeholder: ''
		});

		<?php endif;?>
	});
</script>