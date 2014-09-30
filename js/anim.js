$(document).ready(function() {

	//cantidad de slides
	var numeroSlides = $(".listado li").length;
	
	//muestro el primer slide	
	$( "#sli1" ).css({ 'opacity':1 });
	$( "#sli1" ).css("z-index", 9999 );
	$( ".contProds01 .prod1" ).css('border-bottom', '5px solid #f82452');
	
	//clicks
	$(".sig").click(function() {siguienteSlide(numeroSlides);});
	$(".ant").click(function() {previoSlide(numeroSlides);});
	
	//inicio el slider automatico
	myTimer.set();
	
});


//slider automatico
var myTimer = function(){				
	var intervalo=8000;
	var timer;
	this.set = function() {
		timer = setInterval(function(){
			siguienteSlide($(".listado li").length);
		},intervalo);
	}
	this.reset = function(){
		clearInterval(timer);
		myTimer.set();
	}
	return this;
}();


//siguiente slide
function siguienteSlide(numeroSlides) {
	myTimer.reset();
	for(i=1; i<=numeroSlides;i++){
		if(i!=numeroSlides){
			if($( "#sli"+i ).css("opacity")==1){
				$( "#sli"+i ).animate({opacity: "0",});
				$( "#sli"+i ).css("z-index", 9000 );
				$( ".contProds01 .prod"+i ).css('border-bottom', '0px solid #f82452');
				$( "#sli"+(i+1) ).animate({opacity: "1",});
				$( "#sli"+(i+1) ).css("z-index", 9999 );
				$( ".contProds01 .prod"+(i+1) ).css('border-bottom', '5px solid #f82452');
				return;
			}
		}else {
			if($( "#sli"+i ).css("opacity")==1){
				$( "#sli"+i ).animate({opacity: "0",});
				$( "#sli"+i ).css("z-index", 9000 );
				$( ".contProds01 .prod"+i ).css('border-bottom', '0px solid #f82452');
				$( "#sli"+1 ).animate({opacity: "1",});
				$( "#sli"+1 ).css("z-index", 9999 );
				$( ".contProds01 .prod"+1 ).css('border-bottom', '5px solid #f82452');
				
				return;
			}
		}
	}
	
}


//slide anterior
function previoSlide(numeroSlides) {
	myTimer.reset();
	for(k=1; k<=numeroSlides;k++){
		//alert(k);
		if(k!=1){
			if($( "#sli"+k ).css("opacity")==1){
				$( "#sli"+k ).animate({opacity: "0",});
				$( "#sli"+k ).css("z-index", 9000 );
				$( ".contProds01 .prod"+k ).css('border-bottom', '0px solid #f82452');
				$( "#sli"+(k-1) ).animate({opacity: "1",});
				$( "#sli"+(k-1) ).css("z-index", 9999 );
				$( ".contProds01 .prod"+(k-1) ).css('border-bottom', '5px solid #f82452');
				return;
			}
		}else {
			if($( "#sli"+k ).css("opacity")==1){	
				$( "#sli"+k ).animate({opacity: "0",});
				$( "#sli"+k ).css("z-index", 9000 );
				$( ".contProds01 .prod"+k ).css('border-bottom', '0px solid #f82452');
				$( "#sli"+numeroSlides ).animate({opacity: "1",});
				$( "#sli"+numeroSlides ).css("z-index", 9999 );
				$( ".contProds01 .prod"+numeroSlides ).css('border-bottom', '5px solid #f82452');
				return;
			}
		}
	}

}