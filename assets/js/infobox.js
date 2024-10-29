( function( $ ) {
	"use strict";

    //Accordion
    $('.awesome-addones-accordion-item:first-child').addClass('active');
    $('.awesome-addones-accordion-item:first-child .collapse').addClass('show');
    $('.collapse').on('shown.bs.collapse', function() {
        $(this).parent().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function() {
        $(this).parent().removeClass('active');
    });

    // Popup Video
    $('.awesome-addones-popup-video,.awesome-addones-popup-url').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    // testimonials slide
    $('.awesome-addones-testimonials').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        speed: 500,
    });

    // Counter
    $('.awesome-addones-count').counterUp({
        delay: 10,
        time: 1000
    });

	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/infobox.default', function( $scope, $ ) {
			console.log( $scope );
			// $scope.find('.infobox').hide();
		} );
	} );
	
} )( jQuery );
