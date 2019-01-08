(function( $ ) {
 
    $(function() {
        $('.daisy_store_colorpicker').wpColorPicker();
    });
	
	$('#upload_image_button').click(function() {

        formfield = $('#upload_image').attr('name');
        tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
        return false;
    });
	
	$('#daisy_store_media_remove').click(function() {

        $('#bg-image-wrapper img').remove();
		$('#upload_image').val('');
		
    });
	
    window.send_to_editor = function(html) {

        imgurl = $(html).attr('src');
		$('#bg-image-wrapper').html('<img src="'+imgurl+'" />')
        $('#upload_image').val(imgurl);
        tb_remove();
    }
     
})( jQuery );