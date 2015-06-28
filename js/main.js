/*
  GWSteamLib Core v0.3.1-eng
  Initial Release by Gabriel Wanzek, Nov 2013, with no license.
  Edited by Dylan Myers, June 2015, under the ISC license.

  This code handles Isotope filtering and searching.
  It also handles image error handling and tooltips.
  Finally it sets cookies for logging out, in and themes.

*/
var $container = $('#Grid');

jQuery('document').ready(function($) {

    // init bootstrap tooltips
    $(function() {
        $("[data-toggle='tooltip']").popover();
    });

    // cover up images not found
    $("img").error(function() {
        $(this).attr("src", "img/img404.jpg");
    });

    /* init isotope */
    $container.isotope({
        itemSelector: '.item',
        layoutMode: 'fitRows',
        sortAscending: true,
        getSortData: {
            name: function($elem) {
                return $elem.find('.gamename').text();
            },
            playedtime: function($elem) {
                return parseFloat($elem.attr('data-playedtime'));
            }
        }
    });


    // filtering
    $('#filters a').click(function filterChooseiso() {
        $('#filters a').removeClass("active");
        var selector = $(this).attr('data-filter');
        $(this).addClass("active");
        $container.isotope({filter: selector, sortAscending: true});
        return false;
    });

    // Theme selection
    if(Cookies.get("gwsl_theme") == "dark") {
      $('#themecolour').attr('href','css/custom_dark.css');
    }
    $('#themes a').click(function themeChoose() {
      if($(this).attr("data-theme") == "dark") {
        $('#themecolour').attr('href','css/custom_dark.css');
        Cookies.set("gwsl_theme", "dark");
      }
      else if($(this).attr("data-theme") == "light") {
        $('#themecolour').attr('href','css/custom_light.css');
        Cookies.set("gwsl_theme", "light");
      }
      else {
        $('#themecolour').attr('href','css/custom_light.css');
      }
    });

    $('#logout').click(function logOut() {
      Cookies.remove("gwsl_profile");
      $(location).attr('href','hello.php');
    });

    // sorting
    $('#sort-by a').click(function sortByiso() {
        $('#sort-by a').removeClass("active");
        var sortName = $(this).attr('href').slice(1);
        $(this).addClass("active");
        if (sortName == 'playedtime') {
            $container.isotope({sortBy: sortName, sortAscending: false});
        } else {
            $container.isotope({sortBy: sortName, sortAscending: true});
        }
        ;

        return false;
    });

    // reset filters
    $('#reset_filter').click(function() {
        $('#filters a').removeClass("active");
        $('#sort-by a').removeClass("active");
        $('#search').val('');
    });


    // on load reset layout to isotope
    $(window).scroll(function() {
        $container.isotope('reLayout');
    });
});
