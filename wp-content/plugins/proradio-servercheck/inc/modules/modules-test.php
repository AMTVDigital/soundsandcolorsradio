<h3>Modules details</h3>
<?php  


$loaded = get_loaded_extensions();


$phper = phpversion();
$required = array(
'curl',
'dom',
'exif',
'fileinfo',
'hash',
'json',
'mbstring',
'mysqli',
'openssl',
'pcre',
'xml',
'zip',
'filter',
'iconv',
'SimpleXML',
'xmlreader',
'zlib',
);





?>


<table class="proradio-servercheck__table">
	<tr>
		<th>Module</th>
		<th>Test</th>
	</tr>
	<tr>
		<td>Server software</td>
		<td><?php echo esc_html($_SERVER["SERVER_SOFTWARE"]); ?></td>
	</tr>

	<?php  
	/* PHP version */
	
	$class = 'proradio-servercheck__fail';
	$val = 'FAIL';
	if( version_compare($phper, '7.3', '>=' ) ){
		$class = 'proradio-servercheck__success';
		$val = 'OK';
	}

	?>
	<tr>
		<td>PHP version</td>
		<td class="<?php echo $class; ?>"><?php echo esc_html($phper); echo ' '. esc_html($val); ?></td>
	</tr>
	<?php  
	foreach($required as $req){
		$class = 'proradio-servercheck__fail';
		$val = 'FAIL';
		if( in_array( $req, $loaded ) ){
			$class = 'proradio-servercheck__success';
			$val = 'OK';
		}
		?>
		<tr>
			<td><?php echo esc_html( $req ); ?></td>
			<td class="<?php echo $class; ?>"><?php echo esc_html($val); ?></td>
		</tr>
		<?php  
	}


	// GD or Imagick

	if( !in_array( 'gd', $loaded ) && !in_array( 'imagick', $loaded ) ){
		$class = 'proradio-servercheck__fail';
		$val = 'FAIL';
		
	} else {
		$class = 'proradio-servercheck__success';
		$val = 'OK';
	}

	?>
	<tr>
		<td>imagick OR gd</td>
		<td class="<?php echo $class; ?>"><?php echo esc_html($val); ?></td>
	</tr>
	<?php 



	?>
</table>