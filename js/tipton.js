jQuery(document).ready(function($){
	
	$(".panzoom").panzoom({
		$zoomIn: $(".zoomin"),
		$zoomOut: $(".zoomout"),
		$reset: $(".reset"),
		contain: "invert",
		minScale: 1
	});
		
	$( "#accordion" ).accordion({
      	collapsible: true,
      	active: false,
      	heightStyle: 'content',
      	icons: false
    });
    
    $('.image-link-1').on('click', function(e){
	    e.preventDefault();
	    $('#map, .jet, .hangar85, .hangar84, .hangar80, .terminal, .hangar90, .newhangars, .llfuel, .parking').fadeOut(100);
	    $('.jet').fadeIn(100);
	    
	    $( "#accordion" ).accordion({active:0});
    });
    $('.image-link-2').on('click', function(e){
	    e.preventDefault();
	    $('#map, .jet, .hangar85, .hangar84, .hangar80, .terminal, .hangar90, .newhangars, .llfuel, .parking').fadeOut(100);
	    $('.hangar85').fadeIn(100);
	    $( "#accordion" ).accordion({active:1});
    });
    $('.image-link-3').on('click', function(e){
	    e.preventDefault();
	    $('#map, .jet, .hangar85, .hangar84, .hangar80, .terminal, .hangar90, .newhangars, .llfuel, .parking').fadeOut(100);
	    $('.hangar84').fadeIn(100);
	    $( "#accordion" ).accordion({active:2});
    });
    $('.image-link-4').on('click', function(e){
	    e.preventDefault();
	    $('#map, .jet, .hangar85, .hangar84, .hangar80, .terminal, .hangar90, .newhangars, .llfuel, .parking').fadeOut(100);
	    $('.hangar80').fadeIn(100);
	    $( "#accordion" ).accordion({active:3});
    });
    $('.image-link-5').on('click', function(e){
	    e.preventDefault();
	    $('#map, .jet, .hangar85, .hangar84, .hangar80, .terminal, .hangar90, .newhangars, .llfuel, .parking').fadeOut(100);
	    $('.terminal').fadeIn(100);
	    $( "#accordion" ).accordion({active:4});
    });
    $('.image-link-6').on('click', function(e){
	    e.preventDefault();
	    $('#map, .jet, .hangar85, .hangar84, .hangar80, .terminal, .hangar90, .newhangars, .llfuel, .parking').fadeOut(100);
	    $('.hangar90').fadeIn(100);
	    $( "#accordion" ).accordion({active:5});
    });
    $('.image-link-7').on('click', function(e){
	    e.preventDefault();
	    $('#map, .jet, .hangar85, .hangar84, .hangar80, .terminal, .hangar90, .newhangars, .llfuel, .parking').fadeOut(100);
	    $('.newhangars').fadeIn(100);
	    $( "#accordion" ).accordion({active:6});
    });
    $('.image-link-8').on('click', function(e){
	    e.preventDefault();
	    $('#map, .jet, .hangar85, .hangar84, .hangar80, .terminal, .hangar90, .newhangars, .llfuel, .parking').fadeOut(100);
	    $('.llfuel').fadeIn(100);
	    $( "#accordion" ).accordion({active:7});
    });
    $('.image-link-9').on('click', function(e){
	    e.preventDefault();
	    $('#map, .jet, .hangar85, .hangar84, .hangar80, .terminal, .hangar90, .newhangars, .llfuel, .parking').fadeOut(100);
	    $('.parking').fadeIn(100);
	    $( "#accordion" ).accordion({active:8});
    });
	
	// if esc key is pressed
	var KEYCODE_ESC = 27;
    $(document).keyup(function(e) {
	    e.preventDefault();
		if (e.keyCode == KEYCODE_ESC) 
			$('#map').fadeIn(100);
			$('.jet, .hangar85, .hangar84, .hangar80, .terminal, .hangar90, .newhangars, .llfuel, .parking').fadeOut(100);
			$( "#accordion" ).accordion({
				active:false
			});
	});
	
	// if close button is clicked
	$('.fa-times-circle').on('click', function(e){
	    e.preventDefault();	
	    $('#map').fadeIn(100);
			$('.jet, .hangar85, .hangar84, .hangar80, .terminal, .hangar90, .newhangars, .llfuel, .parking').fadeOut(100);
			$( "#accordion" ).accordion({
				active:false
			});
	});
});