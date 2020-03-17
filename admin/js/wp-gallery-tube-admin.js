(function( $ ) {
	'use strict';

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
		$(function() {
			var mediaUploader;

			$(document).on('click','#wp_gallery_upload_image_btn', function(e) {
			  e.preventDefault();
				if (mediaUploader) {
				mediaUploader.open();
				return;
			  }
			  mediaUploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
				text: 'Choose Image'
			  }, multiple: false });
			  mediaUploader.on('select', function() {
				var attachment = mediaUploader.state().get('selection').first().toJSON();
				$('#studio_logo').val(attachment.url);
				$('#photo').val(attachment.url);
				$('#pornstar_photo').val(attachment.url);
				$('#preview-image-upload').attr("src", attachment.url)
			  });
			  mediaUploader.open();
			});
		});
	


	
})( jQuery );
