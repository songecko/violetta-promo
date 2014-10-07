<div class="prec">
	<div class="loader">
    	<img src="<?php echo $view['assets']->getUrl('images/logo2.png') ?>" width="148" height="79">
        <br><br>
		<img src="<?php echo $view['assets']->getUrl('images/loader.gif') ?>" width="43" height="11">
    </div>
</div>

<div id="fullpage">
	<div class="section" id="section0">
    	<div class="contSeccion01">
        	<div class="arriba">
            	<img src="<?php echo $view['assets']->getUrl('images/violetta.jpg') ?>" class="violetta">
                <div class="contForm">
                	<div class="ajuste"></div>
                	<div class="izq">
                    	<div class="alta">
                            <img src="<?php echo $view['assets']->getUrl('images/logo1.png') ?>" class="logo">
                            <h4>¡Cepillarse ahora <br>es más divertido!</h4>
                            <p class="txt1">Cargá el código de barras de tu producto</p>
                            <p class="txt2">y podrás ganar PREMIOS DE VIOLETTA Y GUM!</p>
                        </div>
                        <div class="baja">
                        	<p class="reco">Recomendado<br>por Odontólogos</p>
                        	<img src="<?php echo $view['assets']->getUrl('images/productos.png') ?>" class="prod">
                        </div>
                    </div>
                    <div class="der">
                    	<p class="ingresa">INGRESÁ EL CÓDIGO DE BARRAS DE TU PRODUCTO</p>
                        <img src="<?php echo $view['assets']->getUrl('images/codigo.png') ?>" class="codigoBarra">
                        <div class="contenedorForm">
                            <form name="formulario1" id="formulario1" method="post" action="<?php echo $view['router']->generate('violetta_participate') ?>">
                                <input type="text" name="code" id="codigo" class="campo" placeholder="Ingresá tu código" 
                                	 onKeypress="if (event.keyCode < 48 || event.keyCode > 57 ) event.returnValue = false;"
                                	data-rule-required="true">
                                <input type="text" class="campo" name="dni" id="dni" placeholder="Ingresá tu número de DNI"
                                	 onKeypress="if (event.keyCode < 48 || event.keyCode > 57 ) event.returnValue = false;"
                                	data-rule-required="true">
                                <div class="clear14"></div>
                                <input type="checkbox" name="terminos1" id="terminos1" class="elCheck" data-rule-required="true">
                                <p class="terminos">Estoy de acuerdo con los <a href="<?php echo $view['router']->generate('bases_condiciones') ?>" target="_blank">Términos & Condiciones</a></p>
                                <input type="submit" value="ENVIAR MI CÓDIGO" class="mandale">
                                <p class="terminos2">Debe aceptar los terminos y condiciones</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        	<div class="abajo">
            	<div class="barra"></div>
                <div class="izq01">
                	<img src="<?php echo $view['assets']->getUrl('images/productos4.jpg') ?>" class="prods">
                </div>
                <div class="der01">
                	<p class="txt02">Podés ganar estos premios de Violetta <br>y productos exclusivos de GUM.</p>
                    <div data-menuanchor="secondPage"><a href="#productos"><p class="masProds">Ver los productos <img src="<?php echo $view['assets']->getUrl('images/abajo.png') ?>" width="18"></p></a></div>
                </div>
            </div>
        </div>
	</div>
    
    
        
	<div class="section" id="section1">
		<div class="contSeccion02">
        	<div class="cont2a">
                <img src="<?php echo $view['assets']->getUrl('images/logo3.png') ?>" class="logo3">
                <p class="frase3">¿Todavía no lo tenés? Conseguilo en <a href="http://www.e-farmacity.com/catalogsearch/result/?q=Gum&lc_brand=283#!2" target="_blank">Farmacity</a> , <a href="https://www3.discovirtual.com.ar/Comprar/Home.aspx" target="_blank">Disco Virtual</a> , <a href="https://www.walmartonline.com.ar/Busqueda.aspx?Text=gum&Departamento=Categoria..." target="_blank">Walmart Online</a></p>
            </div>
            <div class="contSlider">
            	<div class="contFlechas">
                	<div class="ant"></div>
                    <div class="sig"></div>
                </div>
            	<div class="backSlider">
					<ul class="listado">
                    	<li id="sli1">
                        	<div class="info" id="p1">
                            	<img src="<?php echo $view['assets']->getUrl('images/prod1.png') ?>" class="prod">
                                <div class="txt01" id="t1">
                                	<p class="tit">GUM® Crema Dental</p>
                                    <p class="desc">para niños Violetta 100gr</p>
                                    <br>
                                    <p class="carac">
                                    	<img src="<?php echo $view['assets']->getUrl('images/check.png') ?>" class="check">Sabor Tutti Frutti<br>
                                        <img src="<?php echo $view['assets']->getUrl('images/check.png') ?>" class="check">Ayuda a prevenir la caries<br>
                                        <img src="<?php echo $view['assets']->getUrl('images/check.png') ?>" class="check">Ayuda a remover la placa<br>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li id="sli2">
                        	<div class="info" id="p2">
                            	<img src="<?php echo $view['assets']->getUrl('images/prod2.png') ?>" class="prod">
                                <div class="txt01" id="t2">
                                	<p class="tit">GUM® Cepillo Dental</p>
                                    <p class="desc">para niños Violetta</p>
                                    <br>
                                    <p class="carac">
                                    	<img src="<?php echo $view['assets']->getUrl('images/check.png') ?>" class="check">Cerdas suaves delicadas con las encías<br>
                                        <img src="<?php echo $view['assets']->getUrl('images/check.png') ?>" class="check">Cabezal compacto<br>
                                        <img src="<?php echo $view['assets']->getUrl('images/check.png') ?>" class="check">Para niños a partir de 3 años<br>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li id="sli3">
                        	<div class="info" id="p3">
                            	<img src="<?php echo $view['assets']->getUrl('images/prod3.png') ?>" class="prod">
                                <div class="txt01" id="t3">
                                	<p class="tit">GUM® Kit Portátil</p>
                                    <p class="desc">para niños Violetta</p>
                                    <br>
                                    <p class="carac">
                                    	<img src="<?php echo $view['assets']->getUrl('images/check.png') ?>" class="check">Cepillo portátil compacto<br>
                                        <img src="<?php echo $view['assets']->getUrl('images/check.png') ?>" class="check">Crema sabor Tutti Frutti 20gr<br>
                                        <img src="<?php echo $view['assets']->getUrl('images/check.png') ?>" class="check">Perfecto para el cole y actividades fuera de casa<br>
                                        <img src="<?php echo $view['assets']->getUrl('images/check.png') ?>" class="check">Para niños a partir de 6 años<br>
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="bajoSlider">
                	<ul class="contProds01">
                    	<li class="prod1"></li>
                        <li class="prod2"></li>
                        <li class="prod3"></li>
                    </ul>
                </div>
            </div>
        </div>
	</div>
    
    
    
	<div class="section" id="section2">
    	<div class="contSeccion03">
			<h3 class="frase">Consejos para un buen cepillado</h3>
            <ul class="consejos">
            	<li class="extremos"></li>
                <li class="tip">
                	<img src="<?php echo $view['assets']->getUrl('images/tip1.png') ?>" class="elTip">
                    <p class="cons">Cepillate al menos <span>3 veces al día</span> toda la boca durante <span>2 minutos</span></p>
                </li>
                <li class="separadores"></li>
                <li class="tip">
                	<img src="<?php echo $view['assets']->getUrl('images/tip2.png') ?>" class="elTip">
                    <p class="cons2">Acordate de visitar al Odontólogo al menos <span>2 veces al año</span></p>
                </li>
                <li class="separadores"></li>
                <li class="tip">
                	<img src="<?php echo $view['assets']->getUrl('images/tip3.png') ?>" class="elTip">
                    <p class="cons">Cambia tu cepillo cada <span>3 meses</span> o cuando las cerdas se gasten</p>
                </li>
                <li class="extremos"></li>
            </ul>
            <div class="footer">
            	<img src="<?php echo $view['assets']->getUrl('images/logo2.png') ?>" class="logo2">
                <p class="recomendado">Recomendado por Odontólogos</p>
                <div class="footDer">
                    <p class="menu2">&copy;<a href="http://www.latam.gumbrand.com"> 2014 Sunstar GUM</a>         <a href="<?php echo $view['router']->generate('bases_condiciones') ?>" target="_blank">Bases & Condiciones</a>          <a href="http://latam.gumbrand.com/privacy-policy.aspx" target="_blank">Política de Privacidad</a></p>
                    <div class="clear14"></div>
                    <div class="contAtencion">
                        <img src="<?php echo $view['assets']->getUrl('images/phone.png') ?>" class="icono">
                        <p class="mens3">(011) 4816-7144.</p>
                    </div>
                    <div class="contAtencion">
                        <img src="<?php echo $view['assets']->getUrl('images/mail.png') ?>" class="icono">
                        <p class="mens3"><a href="mailto:info@ar.sunstar.com">info@ar.sunstar.com</a></p>
                    </div>
                </div>
                
            </div>
        </div>
	</div>
</div>

<div class="img-preload">
	<img src="<?php echo $view['assets']->getUrl('images/prod1.png') ?> ">
    <img src="<?php echo $view['assets']->getUrl('images/prod2.png') ?> ">
    <img src="<?php echo $view['assets']->getUrl('images/prod3.png') ?> ">
    <img src="<?php echo $view['assets']->getUrl('images/violetta.jpg') ?> ">
    <img src="<?php echo $view['assets']->getUrl('images/fondo1.jpg') ?> ">
    <img src="<?php echo $view['assets']->getUrl('images/fondo1.png') ?> ">
    <img src="<?php echo $view['assets']->getUrl('images/fondo2.jpg') ?> ">
    <img src="<?php echo $view['assets']->getUrl('images/prod1_t.jpg') ?> ">
    <img src="<?php echo $view['assets']->getUrl('images/prod2_t.jpg') ?> ">
    <img src="<?php echo $view['assets']->getUrl('images/prod3_t.jpg') ?> ">
    <img src="<?php echo $view['assets']->getUrl('images/tip1.png') ?> ">
    <img src="<?php echo $view['assets']->getUrl('images/tip2.png') ?> ">
    <img src="<?php echo $view['assets']->getUrl('images/tip3.png') ?>">
</div>
