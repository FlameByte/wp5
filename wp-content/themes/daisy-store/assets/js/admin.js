jQuery(document).ready(function($) {
    $(document).on( 'click', '.dstore-welcome-notice .notice-dismiss', function() {

    $.ajax({
        url: daisy_store_admin.ajaxurl,
        data: {
            action: 'daisy_store_dismiss_notice'
        }
    })

})
});