jQuery( document ).ready(function($) {
	var $window = $(window),
		flexslider = { vars:{} };
 
	// tiny helper function to add breakpoints
	function getGridSize() {
	return (window.innerWidth < 480) ? 2 :
			(window.innerWidth < 768) ? 3 :
	       (window.innerWidth < 1024) ? 4 : 5;
	}

	$('.layer-slider').flexslider({
	    animation: excellent_slider_value.excellent_animation_effect,
	    animationLoop: true,
	    slideshow: true,
	    slideshowSpeed: excellent_slider_value.excellent_slideshowSpeed,
	    animationSpeed: excellent_slider_value.excellent_animationSpeed,
	    direction: excellent_slider_value.excellent_direction,
	    smoothHeight: true
	});

	$('.client-slider').flexslider({
		animation: "slide",
		animationLoop: true,
		slideshow: true,
		controlNav: false,
		directionNav: false,
		smoothHeight: false,
		slideshowSpeed: 5000,
		animationSpeed: 2000,
		itemWidth: 200,
		move: 1,
		minItems: getGridSize(), // use function to pull in initial value
		maxItems: getGridSize() // use function to pull in initial value
	});

	$('.testimonial-slider').flexslider({
		animation: "slide",
		animationLoop: true,
		slideshow: true,
		directionNav: false,
		smoothHeight: false,
		slideshowSpeed: 7000,
		animationSpeed: 2000,
		pauseOnHover: true
	});

	$window.resize(function() {
	    var gridSize = getGridSize();
	 
	    flexslider.vars.minItems = gridSize;
	    flexslider.vars.maxItems = gridSize;
	});
});

		