<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type="text/javascript">
	$(document).ready(function(){
		$('table.zebra tbody > tr:nth-child(odd)').addClass('alt');
		
		$('a.addtoggle').click(function(){
			$('.addtype').slideDown();
			
			return false;
		});
	});
</script>