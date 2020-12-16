const $grid = $('.grid').isotope({
  // options
  itemSelector: '.grid-item',
  layoutMode: 'masonry',
});

// $('#category').on('click', 'button', function(){
//   $('#category button').removeClass("active");
//   $(this).addClass("active")
// });
var filters = {}

function concatValues( obj ) {
  var value = '';
  for ( var prop in obj ) {
    value += obj[ prop ];
  }
  return value;
}

$('.filters').on( 'click', 'button', function( event ) {
  var $button = $( event.currentTarget );
  
  // get group key
  var $buttonGroup = $button.parents('.button-group');
  var filterGroup = $buttonGroup.attr('data-filter-group');
  // set filter for group
  filters[ filterGroup ] = $button.attr('data-filter');
  // combine filters
  var filterValue = concatValues( filters );
  // set filter for Isotope
  $grid.isotope({ filter: filterValue });
  console.log(filters)
});

$('.filter-button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function( event ) {
    $buttonGroup.find('.active').removeClass('active');
    var $button = $( event.currentTarget );
    $button.addClass('active');
  });
});


// $('#category #technic #availability').on( 'click', 'button', function() {
//   var $this = $(this);
//   // get group key
//   var $buttonGroup = $this.parents('.button-group');
//   var filterGroup = $buttonGroup.attr('data-filter-group');
//   // set filter for group
//   filters[ filterGroup ] = $this.attr('data-filter');
//   // combine filters
//   var filterValue = concatValues( filters );
//   $grid.isotope({ filter: filterValue });
//   console.log(filters)
// });




// $('#technic').on('click', 'button', function(){
//   $('#technic button').removeClass("active");
//   $(this).addClass("active")
// });
// $('#technic').on( 'click', 'button', function() {
//   var $this = $(this);
//   // get group key
//   var $buttonGroup = $this.parents('.button-group');
//   var filterGroup = $buttonGroup.attr('data-filter-group');
//   // set filter for group
//   filters[ filterGroup ] = $this.attr('data-filter');
//   // combine filters
//   var filterValue = concatValues( filters );
//   $grid.isotope({ filter: filterValue });
//   console.log(filters)
// });
// $('#availability').on('click', 'button', function(){
//   $('#availability button').removeClass("active");
//   $(this).addClass("active")
// });
// $('#availability').on( 'click', 'button', function() {
//   var $this = $(this);
//   // get group key
//   var $buttonGroup = $this.parents('.button-group');
//   var filterGroup = $buttonGroup.attr('data-filter-group');
//   // set filter for group
//   filters[ filterGroup ] = $this.attr('data-filter');
//   // combine filters
//   var filterValue = concatValues( filters );
//   $grid.isotope({ filter: filterValue });
//   console.log(filters)
// });


