$(document).ready(function()
{	
	//Fullpage feature
	$('#fullpage').fullpage({
		anchors: ['promo', 'productos', 'consejos'],
	});
	
	
	//Hide the preloader
	$( ".prec" ).fadeOut(600);
	
	
	//Form
	var sending = false;
	$(".contenedorForm form").validate(
	{
		onkeyup: false,
		onclick: false,
		onfocusout: false,
		errorPlacement: function(error, element) 
		{
		},
		highlight: function(element, errorClass, validClass) 
		{
		    $(element).addClass(errorClass).removeClass(validClass);
		},
		unhighlight: function(element, errorClass, validClass) 
		{
		    $(element).removeClass(errorClass).addClass(validClass);
		},
		invalidHandler: function(event, validator)
		{
			if (!$('#terminos1').is(":checked"))
			{
				alert('Debes aceptar los Términos y Condiciones para continuar');
				return;
			}
		},
		submitHandler: function(form)
		{
			if(sending == false)
        	{
				sending = true;
	        	$.ajax({
		        	  url: $(form).attr("action"),
		        	  type: "POST",
		        	  data: $(form).serialize(),
		        	  success: function(data, textStatus, xhr) 
		        	  { 
	        			$.magnificPopup.open({
	        				modal: true,
	        				items: {
	        					src: data
	        				},
	        				type: 'inline'
	        			});
		              },
		              complete: function(jqXHR,textStatus)
		              {
		            	  sending = false;
		              }
		        });
        	}
		}
			
	});
	
	var send = false;
	$(".contGanador form").validate(
	{
		onkeyup: false,
		onclick: false,
		onfocusout: false,
		errorPlacement: function(error, element) 
		{
		},
		highlight: function(element, errorClass, validClass) 
		{
			
		    $(element).addClass(errorClass).removeClass(validClass);
		},
		unhighlight: function(element, errorClass, validClass) 
		{
		    $(element).removeClass(errorClass).addClass(validClass);
		},
		invalidHandler: function(event, validator)
		{
			
			//alert("Debes completar todos los campos correctamente para continuar.");
		},
		submitHandler: function(form)
		{
			if(send == false)
        	{
				send = true;
	        	$.ajax({
		        	  url: $(form).attr("action"),
		        	  type: "POST",
		        	  data: $(form).serialize(),
		        	  success: function(data, textStatus, xhr) 
		        	  {  
	        			
	        		
		              },
		              complete: function(jqXHR,textStatus)
		              {
		            	  send = false;
		              }
		        });
        	}
		}
			
	});
	
	
});