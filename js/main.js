

///// NAV STICKY /////

            $(document).ready(function () {  
              $(window).scroll(function (event) {
                // what the y position of the scroll is
                var y = $(this).scrollTop();

                // whether that's below the form
                if (y >= 315 && !$('#top').hasClass('fixed')) {
                  // if so, ad the fixed class
                  $('#top').addClass('fixed');
                  $('#bottom').addClass('fixed');
                } 
                if (y < 315 && $('#top').hasClass('fixed'))  {
                  // otherwise remove it
                  $('#top').removeClass('fixed');
                  $('#bottom').removeClass('fixed');
                }
              });
            });

///// CAROUSEL /////

        $(function() {
         
        var $c = $('#clients'),
            $w = $(window);
         
        $c.carouFredSel({
                align: false,
                items: 10,
                scroll: {
                    items: 1,
                    duration: 3000,
                    timeoutDuration: 0,
                    easing: 'linear',
                    pauseOnHover: 'immediate'
            }
        });
         
        $w.bind('resize.example', function() {
            var nw = $w.width();
            if (nw < 990) {
            nw = 990;
        }
         
        $c.width(nw * 3);
        $c.parent().width(nw);
         
        }).trigger('resize.example');
         
        });

///// DIV OPEN/CLOSE w/ SLIDE /////

$(document).ready(function() {
    $("#about-arrow").click(function(){
    	$('#about-arrow i').toggleClass("icon-question-sign icon-chevron-up");
        $("#about").slideToggle("slow");
    });
});

///// SMOOTH SCROLL /////
$(document).ready(function() {
  $('#top-nav-links a').click(function(){
      $('html, body').animate({
          scrollTop: $( $.attr(this, 'href') ).offset().top
      }, 500);
      return false;
  });
});

///// END /////


/**
 * Parallax Scrolling Tutorial
 * For NetTuts+
 *  
 * Author: Mohiuddin Parekh
 *	http://www.mohi.me
 * 	@mohiuddinparekh   
 */


$(document).ready(function(){
	// Cache the Window object
	$window = $(window);
                
   $('section[data-type="background"]').each(function(){
     var $bgobj = $(this); // assigning the object
                    
      $(window).scroll(function() {
                    
		// Scroll the background at var speed
		// the yPos is a negative value because we're scrolling it UP!								
		var yPos = -($window.scrollTop() / $bgobj.data('speed')); 
		
		// Put together our final background position
		var coords = '50% '+ yPos + 'px';

		// Move the background
		$bgobj.css({ backgroundPosition: coords });
		
}); // window scroll Ends

 });	

}); 
/* 
 * Create HTML5 elements for IE's sake
 */

document.createElement("article");
document.createElement("section");
