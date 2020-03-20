//(function( $ ) {
	//'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 ** /
	
	 /**
	  * When the window is loaded:
	  *
	  * $( window ).load(function() {
		*
		* });
		*
		* ...and/or other possibilities.
		*
		* Ideally, it is not considered best practise to attach more than a
		* single DOM-ready or window-load handler for a particular page.
		* Although scripts in the WordPress core, Plugins and Themes may be
		* practising this, we should strive to set a better example in our own work.
		*/
		var mediaUploader;
		jQuery(function() {
			mediaUploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
				text: 'Choose Image'
			  }, multiple: false });
			jQuery(document).on('click','#wp_gallery_upload_image_btn', function(e) {
			  e.preventDefault();
				if (mediaUploader) {
				mediaUploader.open();
				
				return;
			  }
			  
			  mediaUploader.on('select', function() {
				var attachment = mediaUploader.state().get('selection').first().toJSON();
				jQuery('#studio_logo').val(attachment.url);
				jQuery('#photo').val(attachment.url);
				jQuery('#pornstar_photo').val(attachment.url);
				jQuery('#preview-image-upload').attr("src", attachment.url)

				//jQuery('#studioDetail').modal('show');
			  });
			  

			  mediaUploader.open();
			  
			});
		});
	


	
//})( jQuery );
