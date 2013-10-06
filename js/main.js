$(function() {
    $("[data-toggle='tooltip']").tooltip();
});

$("img").error(function () {
    $(this).attr("src", "img/img404.jpg");
});

$('#isotope').isotope({
  // options
  itemSelector : '#item',
  layoutMode : 'fitRows'
});