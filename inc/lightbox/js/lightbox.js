(function($) {
 
    // Initialize the Lightbox for any links with the 'fancybox' class
    $(".fancybox").fancybox();
    
    $(".fancyboxPage").fancybox({
	    type			: "iframe",
	    autosize		: "true",
	    width			: "1400",
	    overlay      	: 'true',
	    smallBtn 		: true,
	    arrows			: true,
	    openEffect: "elastic",
	    
	    helpers : {
	        overlay : {
	            css : {
	                'background' : 'rgba(0, 0, 0, 0.5)'
	            }
	        }
	    },
	    
	    iframe: {
		    // Iframe template
	        tpl:
	            '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe caso" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen allowtransparency="true" src=""></iframe>',

	    },
	    
    });
    
    $('fancybox.iframe').fancybox({
        wrapCSS : 'caso' 
    });
 
    // Initialize the Lightbox automatically for any links to images with extensions .jpg, .jpeg, .png or .gif
    $("a[href$='.jpg'], a[href$='.png'], a[href$='.jpeg'], a[href$='.gif']").fancybox();
 
    // Initialize the Lightbox and add rel="gallery" to all gallery images when the gallery is set up using [gallery link="file"] so that a Lightbox Gallery exists
    $(".gallery a[href$='.jpg'], .gallery a[href$='.png'], .gallery a[href$='.jpeg'], .gallery a[href$='.gif']").attr('rel','gallery').fancybox();
 
    // Initalize the Lightbox for any links with the 'video' class and provide improved video embed support
    $(".video").fancybox({
        maxWidth        : 800,
        maxHeight       : 600,
        fitToView       : false,
        width           : '70%',
        height          : '70%',
        autoSize        : false,
        closeClick      : false,
        openEffect      : 'none',
        closeEffect     : 'none'
    });
 
})(jQuery);