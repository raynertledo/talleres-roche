/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	const siteNavigation = document.getElementById( 'site-navigation' );

	// Return early if the navigation doesn't exist.
	if ( ! siteNavigation ) {
		return;
	}

	const button = siteNavigation.getElementsByTagName( 'button' )[ 0 ];

	// Return early if the button doesn't exist.
	if ( 'undefined' === typeof button ) {
		return;
	}

	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( ! menu.classList.contains( 'nav-menu' ) ) {
		menu.classList.add( 'nav-menu' );
	}

	// Toggle the .toggled class and the aria-expanded value each time the button is clicked.
	button.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'toggled' );

		if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			button.setAttribute( 'aria-expanded', 'true' );
		}
	} );

	// Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
	document.addEventListener( 'click', function( event ) {
		const isClickInside = siteNavigation.contains( event.target );
        if ( ! isClickInside ) {
			siteNavigation.classList.remove( 'toggled' );
			button.setAttribute( 'aria-expanded', 'false' );
			siteNavigation.classList.remove( 'toggled' );
		}
	} );

	// Get all the link elements within the menu.
	const links = menu.getElementsByTagName( 'a' );

	// Get all the link elements with children within the menu.
	const linksWithChildren = menu.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

	// Toggle focus each time a menu link is focused or blurred.
	for ( const link of links ) {
		link.addEventListener( 'focus', toggleFocus, true );
		link.addEventListener( 'blur', toggleFocus, true );
	}

	// Toggle focus each time a menu link with children receive a touch event.
	for ( const link of linksWithChildren ) {
		link.addEventListener( 'touchstart', toggleFocus, false );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		if ( event.type === 'focus' || event.type === 'blur' ) {
			let self = this;
			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( ! self.classList.contains( 'nav-menu' ) ) {
				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					self.classList.toggle( 'focus' );
				}
				self = self.parentNode;
			}
		}

		if ( event.type === 'touchstart' ) {
			const menuItem = this.parentNode;
			event.preventDefault();
			for ( const link of menuItem.parentNode.children ) {
				if ( menuItem !== link ) {
					link.classList.remove( 'focus' );
				}
			}
			menuItem.classList.toggle( 'focus' );
		}
	}
}() );

jQuery( window ).resize(function() {
           const siteNavigation = document.getElementById( 'site-navigation' );
		   const button = siteNavigation.getElementsByTagName( 'button' )[ 0 ];
			siteNavigation.classList.remove( 'toggled' );
			button.setAttribute( 'aria-expanded', 'false' );
			siteNavigation.classList.remove( 'toggled' );
			document.querySelector('.animated-icon2').classList.remove('open');
		
});



/*1*/
jQuery(document).ready(function(){
	jQuery(".title-taller-description-2").click(function(){
		//jQuery(".content-taller-description").toggleClass("d-none");
		var title_actual = jQuery(this);
		var title_actual_id = title_actual.attr("id");
		var title_actual_post_id = title_actual_id.substr(13);

		jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("d-block");
		jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("positioning");
		//jQuery(".content_taller_description_"+title_actual_post_id).parent().toggleClass("positioning");
		
		//jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("invisible");
		//jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("visible");

		jQuery(".description-hidden-2").toggleClass("d-none");
		jQuery(".description-hidden-2").toggleClass("d-block");
		jQuery(".description-hidden-2").toggleClass("invisible");
		jQuery(".description-hidden-2").toggleClass("visible");

		jQuery(".description-showed-2").toggleClass("d-none");
		jQuery(".description-showed-2").toggleClass("d-block");
		jQuery(".description-showed-2").toggleClass("visible");
		jQuery(".description-showed-2").toggleClass("invisible");

		jQuery(".description-hidden-2").toggleClass("visible");
		jQuery(".title-taller-description-2").toggleClass("cerrado");

		jQuery(".description-showed-2").attr("transform","rotate(360deg)");
	});

	jQuery(".taller-video-presentacion.video").click(function(){
		var actual = jQuery(this);
		var actual_id = actual.attr("id");
		var post_id = actual_id.substr(6);		
		
		if(!actual.hasClass("active")){
			jQuery("#presentacion_"+post_id).removeClass( "active" );
			actual.addClass("active");
			jQuery(".video_"+post_id).addClass("d-block");
			jQuery(".video_"+post_id).removeClass("d-none");

			jQuery(".presentacion_"+post_id).addClass("d-none");
			jQuery(".presentacion_"+post_id).removeClass("d-block");

			jQuery("iframe").attr("width","100%");
			jQuery("iframe").attr("height","400px");
			jQuery("iframe").attr("margin","auto");
			jQuery("iframe").attr("position","relative");
			jQuery("iframe").attr("display","block");	
		}
	});
	jQuery(".taller-video-presentacion.presentacion").click(function(){
		var actual = jQuery(this);
		var actual_id = actual.attr("id");
		var post_id = actual_id.substr(13);		
		
		if(!actual.hasClass("active")){
			jQuery("#video_"+post_id).removeClass( "active" );
			actual.addClass("active");
			jQuery(".video_"+post_id).removeClass("d-block");
			jQuery(".video_"+post_id).addClass("d-none");

			jQuery(".presentacion_"+post_id).removeClass("d-none");
			jQuery(".presentacion_"+post_id).addClass("d-block");

			jQuery("iframe").attr("width","100%");
			jQuery("iframe").attr("height","400px");
			jQuery("iframe").attr("margin","auto");
			jQuery("iframe").attr("position","relative");
			jQuery("iframe").attr("display","block");			
		}
	});
			jQuery("iframe").attr("width","100%");
			jQuery("iframe").attr("height","400px");
			jQuery("iframe").attr("margin","auto");
			jQuery("iframe").attr("position","relative");
			jQuery("iframe").attr("display","block");


document.addEventListener('scroll', function(){
	let elements = document.getElementsByClassName('scroll-content');
	let screenSize = window.innerHeight;
  	
    for(var i = 0; i < elements.length; i++) {
    var element = elements[i];

    if(element.getBoundingClientRect().top < screenSize) {
      	//alert(element.getBoundingClientRect().top);
        element.classList.add('visible-effect');
        element.classList.remove('scroll-content');
    } else {
        element.classList.remove('visible-effect');
      }

    }
});	

    jQuery('.scroll-content1').each(function(){
    		jQuery( this ).removeClass( "scroll-content1" );
		    jQuery( this ).addClass( "visible-effect" );
		  });

});

/*2*/
jQuery(document).ready(function(){
	jQuery(".title-taller-description-1").click(function(){
		//jQuery(".content-taller-description").toggleClass("d-none");
		var title_actual = jQuery(this);
		var title_actual_id = title_actual.attr("id");
		var title_actual_post_id = title_actual_id.substr(13);

		jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("d-block");
		jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("positioning");
		//jQuery(".content_taller_description_"+title_actual_post_id).parent().toggleClass("positioning");
		
		//jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("invisible");
		//jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("visible");

		jQuery(".description-hidden-1").toggleClass("d-none");
		jQuery(".description-hidden-1").toggleClass("d-block");
		jQuery(".description-hidden-1").toggleClass("invisible");
		jQuery(".description-hidden-1").toggleClass("visible");

		jQuery(".description-showed-1").toggleClass("d-none");
		jQuery(".description-showed-1").toggleClass("d-block");
		jQuery(".description-showed-1").toggleClass("visible");
		jQuery(".description-showed-1").toggleClass("invisible");

		jQuery(".description-hidden-1").toggleClass("visible");
		jQuery(".title-taller-description-1").toggleClass("cerrado");

		jQuery(".description-showed-1").attr("transform","rotate(360deg)");
	});

	jQuery(".taller-video-presentacion.video").click(function(){
		var actual = jQuery(this);
		var actual_id = actual.attr("id");
		var post_id = actual_id.substr(6);		
		
		if(!actual.hasClass("active")){
			jQuery("#presentacion_"+post_id).removeClass( "active" );
			actual.addClass("active");
			jQuery(".video_"+post_id).addClass("d-block");
			jQuery(".video_"+post_id).removeClass("d-none");

			jQuery(".presentacion_"+post_id).addClass("d-none");
			jQuery(".presentacion_"+post_id).removeClass("d-block");

			jQuery("iframe").attr("width","100%");
			jQuery("iframe").attr("height","400px");
			jQuery("iframe").attr("margin","auto");
			jQuery("iframe").attr("position","relative");
			jQuery("iframe").attr("display","block");	
		}
	});
	jQuery(".taller-video-presentacion.presentacion").click(function(){
		var actual = jQuery(this);
		var actual_id = actual.attr("id");
		var post_id = actual_id.substr(13);		
		
		if(!actual.hasClass("active")){
			jQuery("#video_"+post_id).removeClass( "active" );
			actual.addClass("active");
			jQuery(".video_"+post_id).removeClass("d-block");
			jQuery(".video_"+post_id).addClass("d-none");

			jQuery(".presentacion_"+post_id).removeClass("d-none");
			jQuery(".presentacion_"+post_id).addClass("d-block");

			jQuery("iframe").attr("width","100%");
			jQuery("iframe").attr("height","400px");
			jQuery("iframe").attr("margin","auto");
			jQuery("iframe").attr("position","relative");
			jQuery("iframe").attr("display","block");			
		}
	});
			jQuery("iframe").attr("width","100%");
			jQuery("iframe").attr("height","400px");
			jQuery("iframe").attr("margin","auto");
			jQuery("iframe").attr("position","relative");
			jQuery("iframe").attr("display","block");


document.addEventListener('scroll', function(){
	let elements = document.getElementsByClassName('scroll-content');
	let screenSize = window.innerHeight;
  	
    for(var i = 0; i < elements.length; i++) {
    var element = elements[i];

    if(element.getBoundingClientRect().top < screenSize) {
      	//alert(element.getBoundingClientRect().top);
        element.classList.add('visible-effect');
        element.classList.remove('scroll-content');
    } else {
        element.classList.remove('visible-effect');
      }

    }
});	

    jQuery('.scroll-content1').each(function(){
    		jQuery( this ).removeClass( "scroll-content1" );
		    jQuery( this ).addClass( "visible-effect" );
		  });

});
/*3*/
jQuery(document).ready(function(){
	jQuery(".title-taller-description-3").click(function(){
		//jQuery(".content-taller-description").toggleClass("d-none");
		var title_actual = jQuery(this);
		var title_actual_id = title_actual.attr("id");
		var title_actual_post_id = title_actual_id.substr(13);

		jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("d-block");
		jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("positioning");
		//jQuery(".content_taller_description_"+title_actual_post_id).parent().toggleClass("positioning");
		
		//jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("invisible");
		//jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("visible");

		jQuery(".description-hidden-3").toggleClass("d-none");
		jQuery(".description-hidden-3").toggleClass("d-block");
		jQuery(".description-hidden-3").toggleClass("invisible");
		jQuery(".description-hidden-3").toggleClass("visible");

		jQuery(".description-showed-3").toggleClass("d-none");
		jQuery(".description-showed-3").toggleClass("d-block");
		jQuery(".description-showed-3").toggleClass("visible");
		jQuery(".description-showed-3").toggleClass("invisible");

		jQuery(".description-hidden-3").toggleClass("visible");
		jQuery(".title-taller-description-3").toggleClass("cerrado");

		jQuery(".description-showed-3").attr("transform","rotate(360deg)");
	});

	jQuery(".taller-video-presentacion.video").click(function(){
		var actual = jQuery(this);
		var actual_id = actual.attr("id");
		var post_id = actual_id.substr(6);		
		
		if(!actual.hasClass("active")){
			jQuery("#presentacion_"+post_id).removeClass( "active" );
			actual.addClass("active");
			jQuery(".video_"+post_id).addClass("d-block");
			jQuery(".video_"+post_id).removeClass("d-none");

			jQuery(".presentacion_"+post_id).addClass("d-none");
			jQuery(".presentacion_"+post_id).removeClass("d-block");

			jQuery("iframe").attr("width","100%");
			jQuery("iframe").attr("height","400px");
			jQuery("iframe").attr("margin","auto");
			jQuery("iframe").attr("position","relative");
			jQuery("iframe").attr("display","block");	
		}
	});
	jQuery(".taller-video-presentacion.presentacion").click(function(){
		var actual = jQuery(this);
		var actual_id = actual.attr("id");
		var post_id = actual_id.substr(13);		
		
		if(!actual.hasClass("active")){
			jQuery("#video_"+post_id).removeClass( "active" );
			actual.addClass("active");
			jQuery(".video_"+post_id).removeClass("d-block");
			jQuery(".video_"+post_id).addClass("d-none");

			jQuery(".presentacion_"+post_id).removeClass("d-none");
			jQuery(".presentacion_"+post_id).addClass("d-block");

			jQuery("iframe").attr("width","100%");
			jQuery("iframe").attr("height","400px");
			jQuery("iframe").attr("margin","auto");
			jQuery("iframe").attr("position","relative");
			jQuery("iframe").attr("display","block");			
		}
	});
			jQuery("iframe").attr("width","100%");
			jQuery("iframe").attr("height","400px");
			jQuery("iframe").attr("margin","auto");
			jQuery("iframe").attr("position","relative");
			jQuery("iframe").attr("display","block");


document.addEventListener('scroll', function(){
	let elements = document.getElementsByClassName('scroll-content');
	let screenSize = window.innerHeight;
  	
    for(var i = 0; i < elements.length; i++) {
    var element = elements[i];

    if(element.getBoundingClientRect().top < screenSize) {
      	//alert(element.getBoundingClientRect().top);
        element.classList.add('visible-effect');
        element.classList.remove('scroll-content');
    } else {
        element.classList.remove('visible-effect');
      }

    }
});	

    jQuery('.scroll-content1').each(function(){
    		jQuery( this ).removeClass( "scroll-content1" );
		    jQuery( this ).addClass( "visible-effect" );
		  });




 jQuery.extend(jQuery.fn, {
	
	validate: function () {
		if (jQuery(this).val().length < 3) {jQuery(this).addClass('error');return false} else {jQuery(this).removeClass('error');return true}
	},
	
	validateEmail: function () {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
		    emailToValidate = jQuery(this).val();
		if (!emailReg.test( emailToValidate ) || emailToValidate == "") {
			jQuery(this).addClass('error');return false
		} else {
			jQuery(this).removeClass('error');return true
		}
	},
});
 
jQuery( '#commentform' ).attr('action','#'); 
jQuery(function(jQuery){
	
	jQuery( '#commentform' ).submit(function(e){
	  e.preventDefault();
		var button = jQuery('#submit'), 
		    respond = jQuery('#respond'), 
		    commentlist = jQuery('.comment-list');
		    //cancelreplylink = jQuery('#cancel-comment-reply-link');
			
		// if user is logged in, do not validate author and email fields
		if( jQuery( '#author' ).length )
			jQuery( '#author' ).validate();
		
		if( jQuery( '#email' ).length )
			jQuery( '#email' ).validateEmail();
			
		// validate comment in any case
		jQuery( '#comment' ).validate();
		
		// if comment form isn't in process, submit it
		if ( !button.hasClass( 'loadingform' ) && !jQuery( '#author' ).hasClass( 'error' ) && !jQuery( '#email' ).hasClass( 'error' ) && !jQuery( '#comment' ).hasClass( 'error' ) ){
			
			// ajax request
			jQuery.ajax({
				type : 'POST',
				url : ajax_comment_params.ajaxurl, // admin-ajax.php URL
				data: jQuery(this).serialize() + '&action=ajaxcomments', // send form data + action parameter
				beforeSend: function(xhr){
					// what to do just after the form has been submitted
					button.addClass('loadingform').val('Loading...');
				},
				error: function (request, status, error) {
					if( status == 500 ){
						alert( 'Error while adding comment' );
					} else if( status == 'timeout' ){
						alert('Error: Server doesn\'t respond.');
					} else {
						// process WordPress errors
						var wpErrorHtml = request.responseText.split("<p>"),
							wpErrorStr = wpErrorHtml[1].split("</p>");
							
						alert( wpErrorStr[0] );
					}
				},
				success: function ( addedCommentHTML ) {
					
					// if this post already has comments
					if( commentlist.length > 0 ){
					
						// if in reply to another comment
						if( respond.parent().hasClass( 'comment' ) ){
						
							// if the other replies exist
							if( respond.parent().children( '.children' ).length ){	
								respond.parent().children( '.children' ).append( addedCommentHTML );
							} else {
								// if no replies, add <ol class="children">
								addedCommentHTML = '<ol class="children">' + addedCommentHTML + '</ol>';
								respond.parent().append( addedCommentHTML );
							}
							// close respond form
							//cancelreplylink.trigger("click");
						} else {
							// simple comment
							commentlist.append( addedCommentHTML );
						}
					}else{
						// if no comments yet
						addedCommentHTML = '<ol class="comment-list">' + addedCommentHTML + '</ol>';
						respond.before( jQuery(addedCommentHTML) );
					}
					// clear textarea field
					jQuery('#comment').val('');
				},
				complete: function(){
					// what to do after a comment has been added
					button.removeClass( 'loadingform' ).val( 'Post Comment' );
				}
			});
		}
		return false;
	});
});










});