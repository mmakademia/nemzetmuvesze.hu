// global. currently active menu item 
var current_item = 0;

// few settings
var section_hide_time = 1000;
var section_show_time = 1000;

// jQuery stuff
jQuery(document).ready(function($) {

    // Switch section
    $("a", '.navbar-collapse').click(function() {
        if (!$(this).hasClass('active')) {
            current_item = this;
            // close all visible divs with the class of .section
            $('.section:visible').fadeOut(section_hide_time, function() {
                $('a', '.navbar-collapse').removeClass('active');
                $(current_item).addClass('active');
                var new_section = $($(current_item).attr('href'));
                new_section.fadeIn(section_show_time);
            });
        }
        return false;
    });

    // auto toggle navbar - fuck it!
    $('.nav a').on('click', function() {
        $(".navbar-toggle").click()
    });
});
