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
    <link rel="stylesheet" href="../css/style-2.css">


    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

  <title>Gestion de expedientes</title>
</head>
<body>
    <!-- <div class="container showgrid"> -->
	<div class="jumboImagen">

	</div>
    <div class="container">

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<form action="<?php echo base_url().'login/new_user';?>" method="POST" class="form-horizontal" role="form">
				
				<div class="form-group">
					<legend><?php echo $titulo?></legend>
				</div>
				
				<div class="form-group <?php if (isset($estilo)) {echo $estilo;}?>">
					<div class="col-sm-6 col-sm-offset-2 ">
						<label for="username" class="control-label">Nombre de usuario:</label>
						<input type="text" name="username" id="username" class="form-control" placeholder="nombre de usuario"><p class="bg-danger">
						<!-- En el form_error, el estilo css lo defino en el controlador. Ver controlador "login"-->
						<?=form_error('username')?>
						
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-6 col-sm-offset-2">
						<label for="password" class="control-label">Introduce tu password:</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="introduce tu password">
						<?=form_error('password')?>
					</div>
				</div>			

				<?=form_hidden('token',$token)?>
				
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button type="submit" class="btn btn-primary">Log in</button>
					</div>
				</div>
				
				<?php 
					if($this->session->flashdata('usuario_incorrecto'))
					{
				?>
						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-2">
								<p class="bg-danger"><?=$this->session->flashdata('usuario_incorrecto')?></p>
							</div>
						</div>		
				<?php
					}
				?>
		</form>
	</div>	
	<!-- Botón que nos lleva al formulario de dar de alta a un nuevo usuario -->
	<legend>Dar de alta</legend>
	<div class="col-sm-6 col-sm-offset-2">
		<a href="<?php echo base_url().'login/goNewUser';?>" class="btn btn-primary btn-lg btn-block active" role="button">Nuevo usuario</a>
	</div>
</div>
</body>
</html>