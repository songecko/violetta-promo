<!DOCTYPE html>
<!--[if lt IE 9]> <html lang="es-ES" class="ielt9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es-ES"> <!--<![endif]-->
	<head>
		<meta charset="UTF-8" />
		<title>DIRECTV - Grita Viva Puerto Rico</title>
		
		<meta name="description" content="Grita 'Viva Puerto Rico' con DIRECTV">
		
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
    		
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
		
		<script src="<?php echo $view['assets']->getUrl('js/vendor/jquery-1.10.2.min.js') ?>"></script>
		<script src="<?php echo $view['assets']->getUrl('js/vendor/jquery.validate.min.js') ?>"></script>
		<?php if($container->get('mobile_detect')->isMobile()): ?>
		<script src="<?php echo $view['assets']->getUrl('js/mobile.js') ?>"></script>
		<?php endif; ?>
		<script src="<?php echo $view['assets']->getUrl('js/main.js') ?>"></script>
	</body>
</html>