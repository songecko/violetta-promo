<?php if($error): ?>
	<p class="bg-danger error"><?php echo $error ?></p>
<?php endif; ?>
	
<div class="panel panel-default login">
	<div class="panel-heading">Login</div>
	
	<form role="form" action="<?php echo $view['router']->generate('backend_login') ?>" method="post" class="form">
		<div class="form-group">
			<label for="login_username">Usuario:</label>
			<input class="form-control" type="text" id="login_username" name="login[username]">
		</div>
		<div class="form-group">
			<label for="login_password">Contraseña:</label>
			<input class="form-control" type="password" id="login_password" name="login[password]">
		</div>
		
		<button type="submit" class="btn btn-default">Ingresar</button>
	</form>
</div>