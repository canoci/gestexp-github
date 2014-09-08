<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html>
<head>
    <meta charset="utf-8">

        <!--custom css-->
        <link href="<?php echo asset_url('css/style.css');?>" rel="stylesheet">
        <!--google web fonts css-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
        <!--ion icons css-->
        <link href="<?php echo asset_url('icons/css/ionicons.min.css');?>" rel="stylesheet">
        <!--animated css-->
        <link href="<?php echo asset_url('assets/css/animate.css');?>" rel="stylesheet">
        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <!--ion icons css-->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css">
    <!--[if lt IE 8]><link rel="stylesheet" href="<?php echo asset_url(); ?>/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->


    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

  <title>Gestion de expedientes</title>

</head>
<body>
    <div class="container">
    	<?php 
    	if (isset($mensaje) && !(is_null($mensaje))) {
    		echo $mensaje;
    		echo validation_errors();
    	}
    	?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<form action="<?php echo base_url().'login/add_user';?>" method="POST" class="form-horizontal" role="form">
		<div class="form-group">
			<legend>Alta usuario</legend>
		</div>
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<label for="perfil" class="control-label">Perfil</label>
				<select id="perfil" name="perfil" class="form-control">
				  <option value="usuario">Usuario</option>
				  <option value="administrador">Administrador</option>
				</select>				
				<?=form_error('perfil')?>
			</div>
			<div class="col-sm-10 col-sm-offset-2">
				<label for="username" class="control-label">Nombre de usuario</label>
				<input type="text" id="username" name="username" class="form-control" placeholder="Introduce un nombre de usuario" value="<?php echo set_value('username')?>">
				<?=form_error('username')?>
			</div>
			<div class="col-sm-10 col-sm-offset-2">
				<label for="password" class="control-label">Password</label>
				<input type="password" id="password" name="password" class="form-control" placeholder="Introduce un password" value="<?php echo set_value('password')?>">
				<?=form_error('password')?>
			</div>
			<div class="col-sm-10 col-sm-offset-2">
				<label for="passconf" class="control-label">Confirmación del password</label>
				<input type="password" id="passconf" name="passconf" class="form-control" placeholder="Introduce de nuevo el password" value="<?php echo set_value('passconf')?>">
				<?=form_error('passconf')?>
			</div>
			<div class="col-sm-10 col-sm-offset-2">
				<label for=" email" class="control-label">Correo electrónico</label>
				<input type="email" id=" email" name=" email" class="form-control" placeholder="Introduce un email " value="<?php echo set_value('email')?>">
				<?=form_error('email')?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<button type="submit" class="btn btn-primary">Enviar</button>
			</div>
		</div>
	</form>
	</div>
	</div>
</body>
</html>