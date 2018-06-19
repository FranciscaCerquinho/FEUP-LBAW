
$(function() {
    //----- OPEN
    $('[data-popup-reportAuction-open]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-reportAuction-open');
        console.log(targeted_popup_class);

        $('[data-popup-reportAuction="' + targeted_popup_class + '"]').fadeIn(1000);

        e.preventDefault();
    });

    //----- CLOSE
    $('[data-popup-close-reportAuction]').on('click', function(e)  {
        
        var targeted_popup_class = jQuery(this).attr('data-popup-close-reportAuction');
        $('[data-popup-reportAuction="' + targeted_popup_class + '"]').fadeOut(1000);

        e.preventDefault();
    });
});


$(function() {
    //----- OPEN
    $('[data-popup-reportUser-open]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-reportUser-open');

        $('[data-popup-reportUser="' + targeted_popup_class + '"]').fadeIn(1000);

        e.preventDefault();
    });

    //----- CLOSE
    $('[data-popup-close-reportUser]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-close-reportUser');
        $('[data-popup-reportUser="' + targeted_popup_class + '"]').fadeOut(1000);

        e.preventDefault();
    });
});