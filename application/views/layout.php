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
    <script type="text/javascript" src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>


<title>Gestion de expedientes</title>
</head>
<body>
    <!-- <div class="container showgrid"> -->
    <div class="container">
        <!-- contenidos de la cabecera -->
        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">-->
        <?php echo $this->load->view('_header') ?> 
        <!--</div> -->
        <!-- contenidos de la cabecera -->
        <? $this->load->view('_header-sub');?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <!-- contenidos principales de la página -->
        <?php echo $this->load->view('_breadcrumbs') ?> 
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <!-- contenidos principales de la página -->
        <?php echo $this->load->view($content) ?> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <!-- contenidos del pie de página -->
        <?php echo $this->load->view('_footer') ?>
        </div>
    </div>
</body> 
</html>
