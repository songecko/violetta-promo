<div class="contGanador">
	<p class="feliz">¡Felicitaciones!</p>
    <p class="mens">Tu código <span><?php echo $code ?></span> es uno de los <span class="rojo">ganadores</span>. <br>Para recibir tu premio, completá tus datos:</p>
    
    <form name="formGano" id="formGano" class="formGano" method="post" action="<?php echo $view['router']->generate('violetta_update_winner') ?>">
    	<input type="text" placeholder="Nombre completo (como aparece en el DNI)" class="campoGano1" name="winner[fullname]" id="nombre1"
        	data-rule-required="true"
        >
        <input type="text" name="winner[codeDisabled]" value="<?php echo $code ?>" class="campoGano2" disabled="disabled">
        <input type="hidden" name="winner[code]" value="<?php echo $code ?>">
        <input type="text" name="winner[dniDisabled]" value="<?php echo $dni ?>" class="campoGano3" disabled="disabled">
        <input type="hidden" name="winner[dni]" value="<?php echo $dni ?>">
        
        <input type="text" placeholder="Teléfono" class="campoGano2b" name="winner[phone]" id="telefono1"
        	data-rule-required="true"
        >
        <input type="text" placeholder="E-mail" class="campoGano3b" name="winner[email]" id="email1"
        	data-rule-required="true" data-rule-email="true"
        >
        <input type="submit" value="ENVIAR MIS DATOS" class="mandarGano">
    </form>
    
    <p class="mens2">Recordá <span>conservar el envase del producto</span> con el código ganador, y presentar el <span>DNI <br></span>, es necesario para poder entregarte el premio.</p>
    <div class="sesepara">
        <div class="contAtencion" id="primero">
            <img src="<?php echo $view['assets']->getUrl('images/mail.png') ?>" class="icono">
            <p class="mens3"><a href="mailto: info@ar.sunstar.com">info@ar.sunstar.com</a></p>
        </div>
        <div class="contAtencion">
            <img src="<?php echo $view['assets']->getUrl('images/phone.png') ?>" class="icono">
            <p class="mens3">(011) 4816-7144.</p>
        </div>
    </div>
    <img src="<?php echo $view['assets']->getUrl('images/logo2.png') ?>" class="logoGano">
    <a href="#" onclick="window.print(); return false;"><img src="<?php echo $view['assets']->getUrl('images/imprimir.jpg') ?>" class="imprimir"></a>

</div>