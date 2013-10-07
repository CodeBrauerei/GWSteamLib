/* init bootstrap tooltips */
$(function() {
    $("[data-toggle='tooltip']").popover();
});

/* on img 404 -> placeholder img */
$("img").error(function () {
    $(this).attr("src", "img/img404.jpg");
});


/* init isotope */
var $container = $('#Grid');

$container.isotope({
	itemSelector : '.item',
	layoutMode : 'fitRows',
	sortAscending : true,


	getSortData : {
		name : function ( $elem ) {
		  return $elem.find('.gamename').text();
		},
		playedtime : function ( $elem ) {
			return parseFloat($elem.attr('data-playedtime'));
		}
	}
});

/* filtering */
$('#filters a').click(function(){
	$('#filters a').removeClass("active");
	var selector = $(this).attr('data-filter');
	$(this).addClass("active");
	$container.isotope({ filter: selector, sortAscending : true });
	return false;
});

/* sorting */
$('#sort-by a').click(function(){
  $('#sort-by a').removeClass("active");
  var sortName = $(this).attr('href').slice(1);
  $(this).addClass("active");
  if (sortName == 'playedtime') {
  	$container.isotope({ sortBy : sortName, sortAscending : false });
  } else {
  	$container.isotope({ sortBy : sortName, sortAscending : true });	
  };
  
  return false;
});

/* reset filters */
$('#reset_filter').click(function(){
	$('#filters a').removeClass("active");
	$('#sort-by a').removeClass("active");
});


/* on load reset layout to isotope */
$(document).ready(function() {
	setTimeout(function() {
		$('#reset_filter').click();
	}, 1500);
});
