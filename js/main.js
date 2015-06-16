function isMobile(){
    return (
        (navigator.userAgent.match(/Android/i)) ||
		(navigator.userAgent.match(/webOS/i)) ||
		(navigator.userAgent.match(/iPhone/i)) ||
		(navigator.userAgent.match(/iPod/i)) ||
		(navigator.userAgent.match(/iPad/i)) ||
		(navigator.userAgent.match(/BlackBerry/))
    );
}

function setNavPosition(){

	if( !isMobile() ){
		var menuSectionHeight = jQuery('.menu-section').outerHeight(),
			wH = jQuery(window).outerHeight();

		if( menuSectionHeight > wH ){
			jQuery('.menu-section').addClass('menu-section-abs');
		} else {
			jQuery('.menu-section').removeClass('menu-section-abs');
		}
	}
}

jQuery(document).ready(function(){
	function drawStrokeTitle(){
		jQuery(".stroke-title").each(function(){
			var contentWidth = jQuery(this).outerWidth(),
				titleWidth = jQuery('h2', this).outerWidth(),
				titleHeight = jQuery('h2', this).outerHeight(),
				barWidth = (contentWidth - titleWidth) / 2 - 50,
				barTop = titleHeight / 2 - 1;

			jQuery(".stroke-title-line-left", this).css("width", barWidth + "px").css("left", 0).css("top", barTop + "px");
			jQuery(".stroke-title-line-right", this).css("width", barWidth + "px").css("right", 0).css("top", barTop + "px");
		});
	}

	drawStrokeTitle();
	
	function setReviewContentMinHeight(){
		var maxHeight = 0;
		jQuery(".review-content .item").each(function(){
			if( maxHeight < jQuery(this).outerHeight() ){
				maxHeight = jQuery(this).outerHeight();
			}
		});
		jQuery(".review-content-inner").css("min-height", maxHeight + "px");
	}

	setReviewContentMinHeight();
	setNavPosition();

	jQuery(window).resize(function(){
		drawStrokeTitle();
		setReviewContentMinHeight();
		setNavPosition();

		jQuery("#cupon-section-slider-wrapper .item").css("height", jQuery(".cupon-section-message").outerHeight() + 'px');
	});

	jQuery("#cupon-section-slider-wrapper .item").css("height", jQuery(".cupon-section-message").outerHeight() + 'px');

	jQuery(".cake-kind-list .cake-kind-list-menu li").click(function(){
		jQuery(".cake-kind-list-content", jQuery(this).parent().parent().parent()).html(jQuery(".cake-kind-info", this).html());

		jQuery("li", jQuery(this).parent().parent()).removeClass("active");
		jQuery(this).addClass("active");

		jQuery(".cake-kind-list-content .stroke-title", jQuery(this).parent().parent().parent()).each(function(){
			var contentWidth = jQuery(this).outerWidth(),
				titleWidth = jQuery('h2', this).outerWidth(),
				titleHeight = jQuery('h2', this).outerHeight(),
				barWidth = (contentWidth - titleWidth) / 2 - 30,
				barTop = titleHeight / 2 - 1;

			jQuery(".stroke-title-line-left", this).css("width", barWidth + "px").css("left", 0).css("top", barTop + "px");
			jQuery(".stroke-title-line-right", this).css("width", barWidth + "px").css("right", 0).css("top", barTop + "px");
		});
	});

	jQuery(".cake-kind-list").each(function(){
		jQuery(".cake-kind-list .cake-kind-list-content").html(jQuery(".cake-kind-list-menu li.active .cake-kind-info").html());


		jQuery(".cake-kind-list-content .stroke-title", jQuery(this).parent().parent().parent()).each(function(){
			var contentWidth = jQuery(this).outerWidth(),
				titleWidth = jQuery('h2', this).outerWidth(),
				titleHeight = jQuery('h2', this).outerHeight(),
				barWidth = (contentWidth - titleWidth) / 2 - 30,
				barTop = titleHeight / 2 - 1;

			jQuery(".stroke-title-line-left", this).css("width", barWidth + "px").css("left", 0).css("top", barTop + "px");
			jQuery(".stroke-title-line-right", this).css("width", barWidth + "px").css("right", 0).css("top", barTop + "px");
		});
	});

	if( isMobile() ){
		if( jQuery(window).width() < 600 ){
			jQuery('.cake-gallery-section-slider').slick({
				infinite: true,
				speed: 3000,
				slidesToShow: 1,
				adaptiveHeight: true,
				autoplay : true,
			});
		} else {
			jQuery('.cake-gallery-section-slider').slick({
		        infinite: true,
		        speed: 3000,
		        slidesToShow: 1,
		        centerMode: true,
		        variableWidth: true,
		        lazyLoad: 'ondemand',
		        autoplay : true,
		    });
		}
	} else {
		jQuery('.cake-gallery-section-slider').slick({
	        infinite: true,
	        speed: 3000,
	        slidesToShow: 1,
	        centerMode: true,
	        variableWidth: true,
	        lazyLoad: 'ondemand',
	        autoplay : true,
	    });
	}

	if( isMobile() ){
		if( jQuery(window).width() < 600 ){
			jQuery('.the-pastry-section-slider').slick({
				infinite: true,
				speed: 1000,
				slidesToShow: 1,
				adaptiveHeight: true,
				// autoplay : true,
			});
		} else {
			jQuery('.the-pastry-section-slider').slick({
		        infinite: true,
		        speed: 1000,
		        slidesToShow: 1,
		        centerMode: true,
		        variableWidth: true,
		        lazyLoad: 'ondemand',
		        // autoplay : true,
		    });
		}
	} else {
		jQuery('.the-pastry-section-slider').slick({
	        infinite: true,
	        speed: 1000,
	        slidesToShow: 1,
	        centerMode: true,
	        variableWidth: true,
	        lazyLoad: 'ondemand',
	        // autoplay : true,
	    });
	}

	setInterval(function(){
		jQuery('.the-pastry-section-slider-wrapper .slick-next').trigger('click');
	}, 6000)

    jQuery(".bt-contact-form-row").each(function(){
    	jQuery(".bt-contact-form-img", this).css("height", jQuery(".bt-contact-form-inner", this).outerHeight() + 'px');
    });

    function blogReadMoreAction(){
	    jQuery(".blog-item-read-more a").click(function(){
	    	var postid = jQuery(this).attr("data-postid"),
	    		status = jQuery(this).attr("data-status"),
	    		read = jQuery(this).attr("data-read");

	    	if( status == "close" && read == "un-read" ){
	    		jQuery("#blog-content-btn" + postid).addClass("loading-blog");

		    	jQuery.ajax({
		            type: 'POST',
		            dataType: 'json',
		            url: admin_ajax.url,
		            data: {
		                action : 'read_more_post',
		                postid : postid
		            },
		            success: function( res ){
		            	jQuery("#blog-content-close" + postid).addClass("hide");
		            	jQuery("#blog-content-open" + postid).html( res.data ).removeClass("hide");
		            	jQuery("#blog-content-btn" + postid).removeClass("loading-blog").html("close").attr("data-read", "readed").attr("data-status", "open");
		            }
		        });
		    } else if( status == "open" ){
	        	jQuery("#blog-content-close" + postid).removeClass("hide");
		    	jQuery("#blog-content-open" + postid).addClass("hide");
	        	jQuery("#blog-content-btn" + postid).html("read more").attr("data-status", "close");
		    } else if( status == "close" ){
		    	jQuery("#blog-content-close" + postid).addClass("hide");
	        	jQuery("#blog-content-open" + postid).removeClass("hide");
	        	jQuery("#blog-content-btn" + postid).html("close").attr("data-status", "open");
		    }

	    	return false;
	    });
	}

	blogReadMoreAction();

	jQuery("#blog-load-more-btn").click(function(){
		var offset = jQuery(this).attr("data-seek");

		jQuery('#blog-load-more-btn').addClass("loading-blog");

		jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: admin_ajax.url,
            data: {
                action : 'load_more_post',
                offset : offset
            },
            success: function( res ){
            	jQuery('#blog-load-more-btn').removeClass("loading-blog");
            	jQuery(".blog-items").append( res.data );
            	jQuery("#blog-load-more-btn").attr("data-seek", res.offset);

            	if( res.visible == false ){
            		jQuery("#blog-load-more-btn").parent().parent().addClass('hide');
            	}

            	blogReadMoreAction();
            }
        });

		return false;
	});

	jQuery("#menu-main-menu a").click(function( e ){
		if( jQuery("body.home").length > 0 ){ 
			var sectionId = jQuery(this).attr("href");
			sectionId = sectionId.split("#");
			sectionId = "#" + sectionId[1];
			var offsetTop = jQuery(sectionId).offset().top;

			jQuery('html, body').stop().animate({ 
	            scrollTop: offsetTop
	        }, 800
	        , function(){
	        });

	        e.preventDefault();

			return false;
		}
	});

	jQuery(".mobile-menu-wrapper .menu-header ul li a").click(function( e ){
		var sectionId = jQuery(this).attr("href");
		sectionId = sectionId.split("#");
		sectionId = "#" + sectionId[1];
		var offsetTop = jQuery(sectionId).offset().top;

		jQuery('html, body').stop().animate({ 
            scrollTop: offsetTop
        }, 800
        , function(){
        });

        e.preventDefault();

        jQuery(".mobile-toggle-btn").trigger('click');

		return false;
	});

	jQuery(".mobile-toggle-btn").click(function(){
		var status = jQuery(this).attr('data-status'),
			leftPos = jQuery(window).outerWidth() - 85;

		jQuery('.mobile-menu-sidebar-section').css('width', leftPos + 'px')

		if( status == 'close' ){
			jQuery('.mobile-menu-sidebar-section').removeClass('hide');

			jQuery('.content-wrapper').stop().animate({ 
	            left: -leftPos
	        }, 800
	        , function(){
	        });

			jQuery(this).attr('data-status', 'open');
		} else {
			jQuery('.content-wrapper').stop().animate({ 
	            left: 0
	        }, 800
	        , function(){
	        	jQuery('.mobile-menu-sidebar-section').addClass('hide');
	        });

			jQuery(this).attr('data-status', 'close');
		}
	});

	jQuery('.mobile-scroll-top-btn').click(function(){
		jQuery(".mobile-toggle-btn").trigger('click');
	});

	jQuery(window).scroll(function(){
		var scrollTop = jQuery(window).scrollTop(), windowHeight = jQuery(window).height();
		
		if( scrollTop > windowHeight ){
			jQuery('.mobile-scroll-top-btn').removeClass('hide');
		} else {
			jQuery('.mobile-scroll-top-btn').addClass('hide');
		}
	});

	jQuery("a[title='legal-privacy-link']").click(function(){
		var status = jQuery('.legal-privacy-section').attr('data-status');
		
		if( status == 'close' ){
			jQuery('.legal-privacy-section').attr('data-status', 'open').css('display', 'block');
			jQuery('html, body').stop().animate({ 
	            scrollTop: jQuery('.legal-privacy-section').offset().top
	        }, 250
	        , function(){
	        });
		} else {
			jQuery('.legal-privacy-section').attr('data-status', 'close');
			jQuery('.legal-privacy-section').slideUp(250);
		}
		
		return false;
	});
});