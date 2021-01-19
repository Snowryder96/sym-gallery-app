const $grid = $('.grid').isotope({
  itemSelector: '.grid-item',
  layoutMode: 'masonry',
});

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







