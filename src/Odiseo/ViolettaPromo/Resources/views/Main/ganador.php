<div class="contGanador">
	<p class="feliz">¡Felicitaciones!</p>
    <p class="mens">Tu código <span><?php echo $code ?></span> es uno de los <span class="rojo">ganadores</span>. <br>Para recibir tu premio, completá tus datos y retiralo presentando tu DNI:</p>
    
    <form name="formGano" id="formGano" class="formGano" method="post" action="<?php echo $view['router']->generate('violetta_update_winner') ?>">
    	<input type="text" placeholder="Nombre completo (como aparece en el DNI)" class="campoGano1" name="fullname" id="nombre1"
        	data-rule-required="true"
        >
        <input type="text" name="codeDisabled" value="<?php echo $code ?>" class="campoGano2" disabled="disabled">
        <input type="hidden" name="code" value="<?php echo $code ?>">
        <input type="text" name="dniDisabled" value="<?php echo $dni ?>" class="campoGano3" disabled="disabled">
        <input type="hidden" name="dni" value="<?php echo $dni ?>">
        
        <input type="text" placeholder="Teléfono" class="campoGano2b" name="phone" id="telefono1"
        	data-rule-required="true"
        >
        <input type="text" placeholder="E-mail" class="campoGano3b" name="email" id="email1"
        	data-rule-required="true" data-rule-email="true"
        >
        <input type="submit" value="ENVIAR MIS DATOS" class="mandarGano">
    </form>
    
    <p class="mens2">Recordá <span>conservar el envase del producto</span> con el código ganador, y el <span>sticker <br>con el código</span> intacto, son necesarios para poder entregarte el premio.</p>
    
    <img src="<?php echo $view['assets']->getUrl('images/logo2.png')?>" class="logoGano">
    <a href="#"><img src="<?php echo $view['assets']->getUrl('images/imprimir.jpg') ?>" class="imprimir"></a>
</div>