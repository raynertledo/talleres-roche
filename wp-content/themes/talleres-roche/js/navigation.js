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

jQuery(document).ready(function(){
	jQuery(".title-taller-description").click(function(){
		//jQuery(".content-taller-description").toggleClass("d-none");
		var title_actual = jQuery(this);
		var title_actual_id = title_actual.attr("id");
		var title_actual_post_id = title_actual_id.substr(13);

		//jQuery(".content-taller-description").toggleClass("d-block");
		//jQuery(".content-taller-description").toggleClass("positioning");
		
		//jQuery(".content-taller-description").toggleClass("invisible");
		//jQuery(".content-taller-description").toggleClass("visible");

		jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("d-block");
		jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("positioning");
		jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("invisible");
		jQuery(".content_taller_description_"+title_actual_post_id).toggleClass("visible");
		//jQuery(".content-taller-description").toggleClass("opacidad1");
		//jQuery(".content-taller-description").toggle("slow");

		jQuery(".description-hidden").toggleClass("d-none");
		jQuery(".description-hidden").toggleClass("d-block");
		jQuery(".description-hidden").toggleClass("invisible");
		jQuery(".description-hidden").toggleClass("visible");

		jQuery(".description-showed").toggleClass("d-none");
		jQuery(".description-showed").toggleClass("d-block");
		jQuery(".description-showed").toggleClass("visible");
		jQuery(".description-showed").toggleClass("invisible");

		jQuery(".description-hidden").toggleClass("visible");
		jQuery(".title-taller-description").toggleClass("cerrado");

		jQuery(".description-showed").attr("transform","rotate(360deg)");
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

			/*jQuery(".post-thumbnail img").hover(function() {
											  jQuery( this ).fadeOut( 100 );											  
											});*/

});
