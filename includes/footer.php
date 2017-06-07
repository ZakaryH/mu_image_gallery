		</div>
	</div>
	</div>
	<footer class="text-center navbar navbar-default navbar-fixed-bottom">
		<div class="container">
			<b>For educational purposes only. <a href="#top">Back to Top</a></b>
<!-- 			<ul class="nav navbar-nav">
				<?php
					if (isset($_SESSION['SESS_ADMLOGGEDIN'])) {
						echo "<li><a title='Manage' href='" . $config_basedir . "admin/list.php'>Manage</a></li>";
						echo "<li><a title='Log Out' href='" . $config_basedir . "login/index.php?logout'>Admin Log Out</a></li>";
					} else {
						echo "<li><a title='Log In' href='" . $config_basedir . "admin/login.php'>Admin Log In</a></li>";

					}
				?>
			</ul> -->
			
		</div>
	</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="<?php echo $config_basedir; ?>assets/js/jquery-3.1.1.min.js"></script>
	<script src="<?php echo $config_basedir; ?>assets/js/main.js"></script>
	<script src="<?php echo $config_basedir; ?>assets/js/commenting.js"></script>
	<script src="<?php echo $config_basedir; ?>assets/js/lightbox2-master/dist/js/lightbox.min.js"></script>
	<script>
		var inputs = document.querySelectorAll( '.inputfile' );
		Array.prototype.forEach.call( inputs, function( input )
		{
			var label	 = input.nextElementSibling,
				labelVal = label.innerHTML;

			input.addEventListener( 'change', function( e )
			{
				var fileName = '';
				if( this.files && this.files.length > 1 ) {
					fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
				}
				else {
					fileName = e.target.value.split( '\\' ).pop();
				}

				if( fileName ) {
					label.querySelector( 'span' ).innerHTML = fileName;
				}
				else {
					label.innerHTML = labelVal;
				}
			});
		});
	</script>
</body>
</html>