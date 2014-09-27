<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>DIRECTV - Panel de Administración</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('css/vendor/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('css/admin.css') ?>"> 
    </head>
    <body>
    	<div class="container">
			<div class="logo">
				<img class="img-responsive" src="<?php echo $view['assets']->getUrl('images/fbAppIcon.png') ?>"/>
			</div> 
    		<?php echo $content ?>
    	</div>
    	
    	<div class="modal fade" id="alertModal">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      					<h4 class="modal-title">Conversor de video</h4>
      				</div>
      				<div class="modal-body">
        				<p class="message"></p>
      				</div>
    			</div>
  			</div>
		</div>
		
        <script src="<?php echo $view['assets']->getUrl('js/vendor/jquery-1.10.2.min.js') ?>"></script>
        <script src="<?php echo $view['assets']->getUrl('js/vendor/bootstrap.min.js') ?>"></script>
        <script src="<?php echo $view['assets']->getUrl('js/backend.js') ?>"></script>
    </body>
</html>