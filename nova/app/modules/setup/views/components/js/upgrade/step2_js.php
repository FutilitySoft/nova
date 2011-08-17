<script type="text/javascript" src="<?php echo Url::base().MODFOLDER;?>/modules/assets/js/jquery.ajaxq.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('table.zebra tbody > tr:nth-child(odd)').addClass('alt');
		
		$('#next').live('click', function(){
			$('.lower').fadeOut('fast');
			$('#loaded').fadeOut('fast', function(){
				$('#loading').removeClass('hidden');
			});
		});
		
		$('input[name=upgrade_characters_users]').change(function(){
			var checked = $('input[name=upgrade_characters_users]:checked').val();
			
			if (checked == 0)
			{
				$('input[name=upgrade_logs]:nth(1)').attr("checked", true);
				$('input[name=upgrade_logs]').attr("disabled", "disabled");
				
				$('input[name=upgrade_news]:nth(1)').attr("checked", true);
				$('input[name=upgrade_news]').attr("disabled", "disabled");
				
				$('input[name=upgrade_missions]:nth(1)').attr("checked", true);
				$('input[name=upgrade_missions]').attr("disabled", "disabled");
			}
			
			if (checked == 1)
			{
				$('input[name=upgrade_logs]:nth(0)').attr("checked", true);
				$('input[name=upgrade_logs]').attr("disabled", "");
				
				$('input[name=upgrade_news]:nth(0)').attr("checked", true);
				$('input[name=upgrade_news]').attr("disabled", "");
				
				$('input[name=upgrade_missions]:nth(0)').attr("checked", true);
				$('input[name=upgrade_missions]').attr("disabled", "");
			}
		});
		
		$('#start').live('click', function(){
			// characters and users
			if ($('input[name=upgrade_characters_users]:checked').val() == 1)
			{
				var send;
				
				$.ajaxq('queue', {
					beforeSend: function(){
						$('table tbody tr:eq(0) td:eq(1) .loading').removeClass('hidden');
					},
					type: "POST",
					url: "<?php echo Url::site('setup/upgradeajax/upgrade_characters');?>",
					data: send,
					dataType: 'json',
					success: function(data){
						$('table tbody tr:eq(0) td:eq(1) .loading').addClass('hidden');
						
						if (data.code == 1)
						{
							$('table tbody tr:eq(0) td:eq(1) .success').removeClass('hidden');
						}
						else if (data.code == 0)
						{
							$('table tbody tr:eq(0) td:eq(1) .failure').removeClass('hidden');
							$('table tbody tr:eq(0) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(0) td:eq(0) .errors').removeClass('hidden');
						}
						else if (data.code == 2)
						{
							$('table tbody tr:eq(0) td:eq(1) .warning').removeClass('hidden');
							$('table tbody tr:eq(0) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(0) td:eq(0) .errors').removeClass('hidden');
						}
					}
				});
			}
			
			// awards
			if ($('input[name=upgrade_awards]:checked').val() == 1)
			{
				var send;
				
				$.ajaxq('queue', {
					beforeSend: function(){
						$('table tbody tr:eq(1) td:eq(1) .loading').removeClass('hidden');
					},
					type: "POST",
					url: "<?php echo Url::site('setup/upgradeajax/upgrade_awards');?>",
					data: send,
					dataType: 'json',
					success: function(data){
						$('table tbody tr:eq(1) td:eq(1) .loading').addClass('hidden');
						
						if (data.code == 1)
						{
							$('table tbody tr:eq(1) td:eq(1) .success').removeClass('hidden');
						}
						else if (data.code == 0)
						{
							$('table tbody tr:eq(1) td:eq(1) .failure').removeClass('hidden');
							$('table tbody tr:eq(1) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(1) td:eq(0) .errors').removeClass('hidden');
						}
					}
				});
			}
			
			// settings and messages
			if ($('input[name=upgrade_settings]:checked').val() == 1)
			{
				var send;
				
				$.ajaxq('queue', {
					beforeSend: function(){
						$('table tbody tr:eq(2) td:eq(1) .loading').removeClass('hidden');
					},
					type: "POST",
					url: "<?php echo Url::site('setup/upgradeajax/upgrade_settings');?>",
					data: send,
					dataType: 'json',
					success: function(data){
						$('table tbody tr:eq(2) td:eq(1) .loading').addClass('hidden');
						
						if (data.code == 1)
						{
							$('table tbody tr:eq(2) td:eq(1) .success').removeClass('hidden');
						}
						else if (data.code == 0)
						{
							$('table tbody tr:eq(2) td:eq(1) .failure').removeClass('hidden');
							$('table tbody tr:eq(2) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(2) td:eq(0) .errors').removeClass('hidden');
						}
						else if (data.code == 2)
						{
							$('table tbody tr:eq(2) td:eq(1) .warning').removeClass('hidden');
							$('table tbody tr:eq(2) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(2) td:eq(0) .errors').removeClass('hidden');
						}
					}
				});
			}
			
			// personal logs
			if ($('input[name=upgrade_logs]:checked').val() == 1)
			{
				var send;
				
				$.ajaxq('queue', {
					beforeSend: function(){
						$('table tbody tr:eq(3) td:eq(1) .loading').removeClass('hidden');
					},
					type: "POST",
					url: "<?php echo Url::site('setup/upgradeajax/upgrade_logs');?>",
					data: send,
					dataType: 'json',
					success: function(data){
						$('table tbody tr:eq(3) td:eq(1) .loading').addClass('hidden');
						
						if (data.code == 1)
						{
							$('table tbody tr:eq(3) td:eq(1) .success').removeClass('hidden');
						}
						else if (data.code == 0)
						{
							$('table tbody tr:eq(3) td:eq(1) .failure').removeClass('hidden');
							$('table tbody tr:eq(3) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(3) td:eq(0) .errors').removeClass('hidden');
						}
						else if (data.code == 2)
						{
							$('table tbody tr:eq(3) td:eq(1) .warning').removeClass('hidden');
							$('table tbody tr:eq(3) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(3) td:eq(0) .errors').removeClass('hidden');
						}
					}
				});
			}
			
			// news categories and items
			if ($('input[name=upgrade_news]:checked').val() == 1)
			{
				var send;
				
				$.ajaxq('queue', {
					beforeSend: function(){
						$('table tbody tr:eq(4) td:eq(1) .loading').removeClass('hidden');
					},
					type: "POST",
					url: "<?php echo Url::site('setup/upgradeajax/upgrade_news');?>",
					data: send,
					dataType: 'json',
					success: function(data){
						$('table tbody tr:eq(4) td:eq(1) .loading').addClass('hidden');
						
						if (data.code == 1)
						{
							$('table tbody tr:eq(4) td:eq(1) .success').removeClass('hidden');
						}
						else if (data.code == 0)
						{
							$('table tbody tr:eq(4) td:eq(1) .failure').removeClass('hidden');
							$('table tbody tr:eq(4) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(4) td:eq(0) .errors').removeClass('hidden');
						}
						else if (data.code == 2)
						{
							$('table tbody tr:eq(4) td:eq(1) .warning').removeClass('hidden');
							$('table tbody tr:eq(4) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(4) td:eq(0) .errors').removeClass('hidden');
						}
					}
				});
			}
			
			// missions and mission posts
			if ($('input[name=upgrade_missions]:checked').val() == 1)
			{
				var send;
				
				$.ajaxq('queue', {
					beforeSend: function(){
						$('table tbody tr:eq(5) td:eq(1) .loading').removeClass('hidden');
					},
					type: "POST",
					url: "<?php echo Url::site('setup/upgradeajax/upgrade_missions');?>",
					data: send,
					dataType: 'json',
					success: function(data){
						$('table tbody tr:eq(5) td:eq(1) .loading').addClass('hidden');
						
						if (data.code == 1)
						{
							$('table tbody tr:eq(5) td:eq(1) .success').removeClass('hidden');
						}
						else if (data.code == 0)
						{
							$('table tbody tr:eq(5) td:eq(1) .failure').removeClass('hidden');
							$('table tbody tr:eq(5) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(5) td:eq(0) .errors').removeClass('hidden');
						}
						else if (data.code == 2)
						{
							$('table tbody tr:eq(5) td:eq(1) .warning').removeClass('hidden');
							$('table tbody tr:eq(5) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(5) td:eq(0) .errors').removeClass('hidden');
						}
					}
				});
			}
			
			// specs
			if ($('input[name=upgrade_specs]:checked').val() == 1)
			{
				var send;
				
				$.ajaxq('queue', {
					beforeSend: function(){
						$('table tbody tr:eq(6) td:eq(1) .loading').removeClass('hidden');
					},
					type: "POST",
					url: "<?php echo Url::site('setup/upgradeajax/upgrade_specs');?>",
					data: send,
					dataType: 'json',
					success: function(data){
						$('table tbody tr:eq(6) td:eq(1) .loading').addClass('hidden');
						
						if (data.code == 1)
						{
							$('table tbody tr:eq(6) td:eq(1) .success').removeClass('hidden');
						}
						else if (data.code == 0)
						{
							$('table tbody tr:eq(6) td:eq(1) .failure').removeClass('hidden');
							$('table tbody tr:eq(6) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(6) td:eq(0) .errors').removeClass('hidden');
						}
						else if (data.code == 2)
						{
							$('table tbody tr:eq(6) td:eq(1) .warning').removeClass('hidden');
							$('table tbody tr:eq(6) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(6) td:eq(0) .errors').removeClass('hidden');
						}
					}
				});
			}
			
			// tour items
			if ($('input[name=upgrade_tour]:checked').val() == 1)
			{
				var send;
				
				$.ajaxq('queue', {
					beforeSend: function(){
						$('table tbody tr:eq(7) td:eq(1) .loading').removeClass('hidden');
					},
					type: "POST",
					url: "<?php echo Url::site('setup/upgradeajax/upgrade_tour');?>",
					data: send,
					dataType: 'json',
					success: function(data){
						$('table tbody tr:eq(7) td:eq(1) .loading').addClass('hidden');
						
						if (data.code == 1)
						{
							$('table tbody tr:eq(7) td:eq(1) .success').removeClass('hidden');
						}
						else if (data.code == 0)
						{
							$('table tbody tr:eq(7) td:eq(1) .failure').removeClass('hidden');
							$('table tbody tr:eq(7) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(7) td:eq(0) .errors').removeClass('hidden');
						}
						else if (data.code == 2)
						{
							$('table tbody tr:eq(7) td:eq(1) .warning').removeClass('hidden');
							$('table tbody tr:eq(7) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(7) td:eq(0) .errors').removeClass('hidden');
						}
					}
				});
			}
			
			// docking items
			if ($('input[name=upgrade_docking]:checked').val() == 1)
			{
				var send;
				
				$.ajaxq('queue', {
					beforeSend: function(){
						$('table tbody tr:eq(8) td:eq(1) .loading').removeClass('hidden');
					},
					type: "POST",
					url: "<?php echo Url::site('setup/upgradeajax/upgrade_docking');?>",
					data: send,
					dataType: 'json',
					success: function(data){
						$('table tbody tr:eq(8) td:eq(1) .loading').addClass('hidden');
						
						if (data.code == 1)
						{
							$('table tbody tr:eq(8) td:eq(1) .success').removeClass('hidden');
						}
						else if (data.code == 0)
						{
							$('table tbody tr:eq(8) td:eq(1) .failure').removeClass('hidden');
							$('table tbody tr:eq(8) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(8) td:eq(0) .errors').removeClass('hidden');
						}
						else if (data.code == 2)
						{
							$('table tbody tr:eq(8) td:eq(1) .warning').removeClass('hidden');
							$('table tbody tr:eq(8) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(8) td:eq(0) .errors').removeClass('hidden');
						}
					}
				});
			}
			
			// wiki pages
			if ($('input[name=upgrade_wiki]:checked').val() == 1)
			{
				var send;
				
				$.ajaxq('queue', {
					beforeSend: function(){
						$('table tbody tr:eq(9) td:eq(1) .loading').removeClass('hidden');
					},
					type: "POST",
					url: "<?php echo Url::site('setup/upgradeajax/upgrade_wiki');?>",
					data: send,
					dataType: 'json',
					success: function(data){
						$('table tbody tr:eq(9) td:eq(1) .loading').addClass('hidden');
						
						if (data.code == 1)
						{
							$('table tbody tr:eq(9) td:eq(1) .success').removeClass('hidden');
						}
						else if (data.code == 0)
						{
							$('table tbody tr:eq(9) td:eq(1) .failure').removeClass('hidden');
							$('table tbody tr:eq(9) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(9) td:eq(0) .errors').removeClass('hidden');
						}
						else if (data.code == 2)
						{
							$('table tbody tr:eq(9) td:eq(1) .warning').removeClass('hidden');
							$('table tbody tr:eq(9) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(9) td:eq(0) .errors').removeClass('hidden');
						}
					}
				});
			}
			
			// uploads
			if ($('input[name=upgrade_uploads]:checked').val() == 1)
			{
				var send;
				
				$.ajaxq('queue', {
					beforeSend: function(){
						$('table tbody tr:eq(10) td:eq(1) .loading').removeClass('hidden');
					},
					type: "POST",
					url: "<?php echo Url::site('setup/upgradeajax/upgrade_uploads');?>",
					data: send,
					dataType: 'json',
					success: function(data){
						$('table tbody tr:eq(10) td:eq(1) .loading').addClass('hidden');
						
						if (data.code == 1)
						{
							$('table tbody tr:eq(10) td:eq(1) .success').removeClass('hidden');
						}
						else if (data.code == 0)
						{
							$('table tbody tr:eq(10) td:eq(1) .failure').removeClass('hidden');
							$('table tbody tr:eq(10) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(10) td:eq(0) .errors').removeClass('hidden');
						}
						else if (data.code == 2)
						{
							$('table tbody tr:eq(10) td:eq(1) .warning').removeClass('hidden');
							$('table tbody tr:eq(10) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(10) td:eq(0) .errors').removeClass('hidden');
						}
					}
				});
			}
			
			// private messages
			if ($('input[name=upgrade_pm]:checked').val() == 1)
			{
				var send;
				
				$.ajaxq('queue', {
					beforeSend: function(){
						$('table tbody tr:eq(11) td:eq(1) .loading').removeClass('hidden');
					},
					type: "POST",
					url: "<?php echo Url::site('setup/upgradeajax/upgrade_private_messages');?>",
					data: send,
					dataType: 'json',
					success: function(data){
						$('table tbody tr:eq(11) td:eq(1) .loading').addClass('hidden');
						
						if (data.code == 1)
						{
							$('table tbody tr:eq(11) td:eq(1) .success').removeClass('hidden');
						}
						else if (data.code == 0)
						{
							$('table tbody tr:eq(11) td:eq(1) .failure').removeClass('hidden');
							$('table tbody tr:eq(11) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(11) td:eq(0) .errors').removeClass('hidden');
						}
						else if (data.code == 2)
						{
							$('table tbody tr:eq(11) td:eq(1) .warning').removeClass('hidden');
							$('table tbody tr:eq(11) td:eq(0) .errors .errors-content').html(data.message);
							$('table tbody tr:eq(11) td:eq(0) .errors').removeClass('hidden');
						}
					}
				});
			}
			
			$('#start').ajaxStop(function(){
				$(this).attr('id', 'next').html('Next Step');
 			});
			
			return false;
		});
	});
</script>