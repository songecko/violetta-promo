<!DOCTYPE html>
<!--[if lt IE 9]> <html lang="es-ES" class="ielt9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es-ES"> <!--<![endif]-->
	<head>
		<meta charset="UTF-8" />
		<title>GUM - Violetta</title>
		<meta name="author" content="Alvaro Trigo Lopez" />
		<meta name="description" content="fullPage plugin by Alvaro Trigo. Create fullscreen pages fast and simple. One page scroll like iPhone website." />
		<meta name="keywords"  content="fullpage,jquery,alvaro,trigo,plugin,fullscren,screen,full,iphone5,apple" />
		<meta name="Resource-type" content="Document" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
        
		<link href="<?php echo $view['assets']->getUrl('css/reset.css') ?>" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?php echo $view['assets']->getUrl('css/jquery.fullPage.css') ?>" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?php echo $view['assets']->getUrl('css/jquery.fancybox.css') ?>" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?php echo $view['assets']->getUrl('css/magnific-popup.css') ?>" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?php echo $view['assets']->getUrl('css/estilos.css') ?>" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?php echo $view['assets']->getUrl('css/main.css') ?>" rel="stylesheet" type="text/css" media="screen" />
	    	
		<?php if($container->get('mobile_detect')->isMobile()): ?>
		<link href="<?php echo $view['assets']->getUrl('css/mobile.css') ?>" rel="stylesheet" type="text/css" media="screen" />
		<?php endif; ?>
		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body<?php echo ($container->get('mobile_detect')->isMobile())?' class="mobile"':'' ?>>
		<?php echo $content ?>
 		<script src="<?php echo $view['assets']->getUrl('js/vendor/jquery-1.9.1.js') ?>"></script>
 		<script src="<?php echo $view['assets']->getUrl('js/vendor/jquery.min.js') ?>"></script>
 		<script src="<?php echo $view['assets']->getUrl('js/vendor/jquery-ui.min.js') ?>"></script>
 		<script src="<?php echo $view['assets']->getUrl('js/vendor/jquery.fancybox.js') ?>"></script>
 		<script src="<?php echo $view['assets']->getUrl('js/anim.js') ?>"></script>   
		<script src="<?php echo $view['assets']->getUrl('js/vendor/jquery.fullPage.js') ?>"></script>
 		<script src="<?php echo $view['assets']->getUrl('js/vendor/jquery.magnific-popup.js') ?>"></script>   
		<script src="<?php echo $view['assets']->getUrl('js/vendor/jquery.validate.min.js') ?>"></script>
		<?php if($container->get('mobile_detect')->isMobile()): ?>
		<script src="<?php echo $view['assets']->getUrl('js/mobile.js') ?>"></script>
		<?php endif; ?>
		<script src="<?php echo $view['assets']->getUrl('js/main.js') ?>"></script>
		<script> 
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ 
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), 
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) 
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); 
		
		  ga('create', 'UA-55600782-1', 'auto'); 
		  ga('send', 'pageview'); 
		
		</script> 
	</body>
</html>