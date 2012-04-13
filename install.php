<?php

if (version_compare(PHP_VERSION, '5.3', '<'))
{
	// Clear out the cache to prevent errors. This typically happens on Windows/FastCGI.
	clearstatcache();
}
else
{
	// Clearing the realpath() cache is only possible PHP 5.3+
	clearstatcache(true);
}

?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Nova 3 Install Tests</title>

		<link rel="stylesheet" href="nova/modules/assets/css/bootstrap.min.css">
		<style>
			body {
				background: #fafafa;
				color: #333;
			}
			p, td, th {
				font-size: 14px;
				line-height: 1.6;
			}
			.fail {
				color: #c00;
			}
			#results {
				padding: .75em;
				color: #fff;
				font-size: 18px;
				border-radius: 4px 4px 4px 4px;
			}
			#results.pass {
				background: #191;
			}
			#results.fail {
				background: #911;
			}
			#results code {
				background: rgba(255, 255, 255, .5);
				border: none;
				font-size: 18px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1>Environment Tests</h1>
			</div>
			
			<div class="row">
				<div class="span3">
					<p>Nova 3 has been designed to work on as many servers as possible. That being said, there are still some requirements that must be met in order for Nova 3 to run. These environment tests are designed to determine if Nova 3 will run on our server. If any of these tests have failed, Nova 3 won't work and you'll need to contact your host to address the problems (except for issues of directory writability).</p>
				</div>
				
				<div class="span9">
					<?php $failed = false;?>

					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="span3">Component</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>PHP Version</td>
								<?php if (version_compare(PHP_VERSION, '5.3.0', '>=')): ?>
									<td><?php echo PHP_VERSION ?></td>
								<?php else: $failed = true;?>
									<td class="fail">Nova 3 requires PHP 5.3 or newer, you are running version <?php echo PHP_VERSION ?>.</td>
								<?php endif;?>
							</tr>
							<tr>
								<td>MySQL Enabled</td>
								<?php if (function_exists('mysql_connect')): ?>
									<td>Pass</td>
								<?php else: $failed = true;?>
									<td class="fail">FuelPHP can use the <a href="http://php.net/mysql">MySQL</a> extension to support MySQL databases.</td>
								<?php endif;?>
							</tr>
							<tr>
								<td>FuelPHP</td>
								<?php if (is_dir('nova/fuel') AND is_dir('nova/packages') AND is_file('nova/fuel/classes/fuel.php')): ?>
									<td><code>nova/fuel/</code>, <code>nova/packages/</code></td>
								<?php else: $failed = true;?>
									<td class="fail">The FuelPHP directory does not exist or does not contain required files.</td>
								<?php endif;?>
							</tr>
							<tr>
								<td>Nova Core</td>
								<?php if (is_dir('nova/modules/nova') AND is_dir('nova/modules/setup') AND is_dir('nova/modules/assets')): ?>
									<td><code>nova/modules/nova/</code>, <code>nova/modules/setup</code>, <code>nova/modules/assets/</code></td>
								<?php else: $failed = true;?>
									<td class="fail">The Nova core does not exist or is missing required directories.</td>
								<?php endif;?>
							</tr>
							<tr>
								<td>Application Directory</td>
								<?php if (is_dir('app') AND is_file('app/bootstrap.php')): ?>
									<td><code>app/</code></td>
								<?php else: $failed = true;?>
									<td class="fail">The <code>app</code> directory does not exist or does not contain required files.</td>
								<?php endif;?>
							</tr>
							<tr>
								<td>Cache Directory</td>
								<?php if (is_dir('app') AND is_dir('app/cache') AND is_writable('app/cache')): ?>
									<td><code>app/cache/</code> exists and is writable</td>
								<?php else: $failed = true;?>
									<td class="fail">The <code>app/cache/</code> directory is not writable.</td>
								<?php endif;?>
							</tr>
							<tr>
								<td>Logs Directory</td>
								<?php if (is_dir('app') AND is_dir('app/logs') AND is_writable('app/logs')): ?>
									<td><code>app/logs/</code> exists and is writable</td>
								<?php else: $failed = true;?>
									<td class="fail">The <code>app/logs/</code> directory is not writable.</td>
								<?php endif;?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<?php if ($failed === true): ?>
				<p id="results" class="fail">Nova 3 will not work in your environment. Please contact your host to address these issues.</p>
			<?php else: ?>
				<p id="results" class="pass">Your environment passed all requirements. Please remove or rename the <code>install.php</code> file now.</p>
			<?php endif;?>
			
			<div class="page-header">
				<h1>Optional Tests</h1>
			</div>
			
			<div class="row">
				<div class="span3">
					<p>These options tests will determine if extensions and classes are available for use. The following extensions are not required to run Nova 3, but if enabled can provide additional functionality.</p>
				</div>
				
				<div class="span9">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="span3">Component</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>mbstring Enabled</td>
								<?php if (extension_loaded('mbstring')): ?>
									<td>Pass</td>
								<?php else: ?>
									<td class="fail">The <a href="http://php.net/mbstring">mbstring</a> extension is not loaded. Nova will not have multibyte support.</td>
								<?php endif;?>
							</tr>
							<tr>
								<td>mcrypt Enabled</td>
								<?php if (extension_loaded('mcrypt')): ?>
									<td>Pass</td>
								<?php else: ?>
									<td class="fail">The <a href="http://php.net/mcrypt">mcrypt</a> extension is not loaded. PHPSecLib will be used to emulate its functionality.</td>
								<?php endif;?>
							</tr>
							<tr>
								<td>fileinfo Enabled</td>
								<?php if (extension_loaded('fileinfo')): ?>
									<td>Pass</td>
								<?php else: ?>
									<td class="fail">The <a href="http://us.php.net/manual/en/book.fileinfo.php">fileinfo</a> extension is not loaded. If you are running on a Windows server, additional DLLs may need to be installed in order for FileInfo to work.</td>
								<?php endif;?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>