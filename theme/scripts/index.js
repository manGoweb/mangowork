/**
	Requires
*/
require('./jquery.bxslider.min')

/**
	Variables
*/
var dc = $(document)
var win = $(window)
var body = $(document.body)

var desktop = win.width() > 990

/**
	Counter
*/
var counter = document.getElementById("js-count");
if(counter != undefined){
	var counter_value = counter.dataset.count;

	var options = {
	  separator : '',
	};

	var numAnim = new CountUp(counter, 0, counter_value, 0, 3.5, options);
	numAnim.start();
}

/**
	Grid
*/
handler = $('#js-grid').wookmark({
  offset: 40
});

/**
	Inits
*/
$('.js-gallery').magnificPopup({
  delegate: 'a',
  type: 'image',
  gallery: {
      enabled: true
    }
});

$('.js-iframe').magnificPopup({
  type: 'iframe'
});

$('body').magnificPopup({
  delegate: '.js-popup-contact',
  removalDelay: 500,
  callbacks: {
    beforeOpen: function() {
       this.st.mainClass = 'mfp-3d-unfold'
    }
  }
});


/**
	binds
*/
$('.js-nav-toggle').on('click', function(e){
	body.toggleClass('site-nav-is-open')
	e.preventDefault()
})


/**
	translate magnifi
*/
$.extend(true, $.magnificPopup.defaults, {
  tClose: 'Zavřít (Esc)', // Alt text on close button
  tLoading: 'Načítám...', // Text that is displayed during loading. Can contain %curr% and %total% keys
  gallery: {
    tPrev: 'Předchozí (Šipka doleva)', // Alt text on left arrow
    tNext: 'Další (Šipka doprava)', // Alt text on right arrow
    tCounter: '%curr% z %total%' // Markup for "1 of 7" counter
  },
  image: {
    tError: '<a href="%url%">Fotku</a> se nepovedlo načíst.' // Error message when image could not be loaded
  },
  ajax: {
    tError: '<a href="%url%">Obsah</a> se nepovedlo načíst.' // Error message when ajax request failed
  }
});


