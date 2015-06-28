/**
 * Custom jQuery for Custom Metaboxes and Fields
 */

/*jslint browser: true, devel: true, indent: 4, maxerr: 50, sub: true */
/*global jQuery, tb_show, tb_remove */

'use strict';

var AS = {

	_initCallbacks: [],
	_clonedFieldCallbacks: [],
	_deletedFieldCallbacks: [],

	_sortStartCallbacks: [],
	_sortEndCallbacks: [],
	
	init : function() {

		jQuery( '.field.repeatable' ).each( function() {
			AS.isMaxFields( jQuery(this) );
		} );

		// Unbind & Re-bind all AS events to prevent duplicates.
		jQuery(document).unbind( 'click.AS' );
		jQuery(document).on( 'click.AS', '.as-delete-field', AS.deleteField );
		jQuery(document).on( 'click.AS', '.repeat-field', AS.repeatField );

		// When toggling the display of the meta box container - reinitialize
		jQuery(document).on( 'click.AS', '.handlediv', AS.init )

		AS.doneInit();

		jQuery('.field.as-sortable' ).each( function() { 
			AS.sortableInit( jQuery(this) );
		} );


	},

	repeatField : function( e ) {

		var templateField, newT, field, index, attr;

		field = jQuery( this ).closest('.field' );					

		e.preventDefault();
		jQuery(this).blur();

		if ( AS.isMaxFields( field, 1 ) )
			return;

		templateField = field.children( '.field-item.hidden' );

		newT = templateField.clone();
		newT.removeClass( 'hidden' );
		
		var excludeInputTypes = '[type=submit],[type=button],[type=checkbox],[type=radio],[readonly]';
		newT.find( 'input' ).not( excludeInputTypes ).val( '' );

		newT.find( '.as_upload_status' ).html('');

		newT.insertBefore( templateField );

		 // Recalculate group ids & update the name fields..
		index = 0;
		attr  = ['id','name','for','data-id','data-name'];

		field.children( '.field-item' ).not( templateField ).each( function() {

			var search  = field.hasClass( 'AS_Group_Field' ) ? /as-group-(\d|x)*/g : /as-field-(\d|x)*/g;
			var replace = field.hasClass( 'AS_Group_Field' ) ? 'as-group-' + index : 'as-field-' + index;

			jQuery(this).find( '[' + attr.join('],[') + ']' ).each( function() {

				for ( var i = 0; i < attr.length; i++ )
					if ( typeof( jQuery(this).attr( attr[i] ) ) !== 'undefined' )
						jQuery(this).attr( attr[i], jQuery(this).attr( attr[i] ).replace( search, replace ) );

			} );

			index += 1;

		} );

		AS.clonedField( newT );

		if ( field.hasClass( 'as-sortable' ) )
			AS.sortableInit( field );


	},

	deleteField : function( e ) {

		var fieldItem, field;

		e.preventDefault();
		jQuery(this).blur();

		fieldItem = jQuery( this ).closest('.field-item' );
		field     = fieldItem.closest( '.field' );

		AS.isMaxFields( field, -1 );
		AS.deletedField( fieldItem );

		fieldItem.remove();

	},

	/**
	 * Prevent having more than the maximum number of repeatable fields.
	 * When called, if there is the maximum, disable .repeat-field button.
	 * Note: Information Passed using data-max attribute on the .field element.
	 *
	 * @param jQuery .field
	 * @param int modifier - adjust count by this ammount. 1 If adding a field, 0 if checking, -1 if removing a field... etc
	 * @return null
	 */
	isMaxFields: function( field, modifier ) {

		var count, addBtn, min, max, count;

		modifier = (modifier) ? parseInt( modifier, 10 ) : 0;

		addBtn = field.children( '.repeat-field' );
		count  = field.children('.field-item').not('.hidden').length + modifier; // Count after anticipated action (modifier)
		max    = field.attr( 'data-rep-max' );

		// Show all the remove field buttons.
		field.find( '> .field-item > .as-delete-field, > .field-item > .group > .as-delete-field' ).show();

		if ( typeof( max ) === 'undefined' )
			return false;

		// Disable the add new field button?
		if ( count >= parseInt( max, 10 ) )
			addBtn.attr( 'disabled', 'disabled' );
		else 
			addBtn.removeAttr( 'disabled' );

		if ( count > parseInt( max, 10 ) )
			return true;

	},

	addCallbackForInit: function( callback ) {

		this._initCallbacks.push( callback )

	},

	/**
	 * Fire init callbacks.
	 * Called when AS has been set up.
	 */
	doneInit: function() {

		var _this = this,
			callbacks = AS._initCallbacks;

		if ( callbacks ) {
			for ( var a = 0; a < callbacks.length; a++) {
				callbacks[a]();
			}
		}

	},

	addCallbackForClonedField: function( fieldName, callback ) {

		if ( jQuery.isArray( fieldName ) )
			for ( var i = 0; i < fieldName.length; i++ )
				AS.addCallbackForClonedField( fieldName[i], callback );

		this._clonedFieldCallbacks[fieldName] = this._clonedFieldCallbacks[fieldName] ? this._clonedFieldCallbacks[fieldName] : []
		this._clonedFieldCallbacks[fieldName].push( callback )

	},

	/**
	 * Fire clonedField callbacks.
	 * Called when a field has been cloned.
	 */
	clonedField: function( el ) {

		// also check child elements
		el.add( el.find( 'div[data-class]' ) ).each( function( i, el ) {

			el = jQuery( el )
			var callbacks = AS._clonedFieldCallbacks[el.attr( 'data-class') ]

			if ( callbacks )
				for ( var a = 0; a < callbacks.length; a++ )
					callbacks[a]( el );

		})
	},

	addCallbackForDeletedField: function( fieldName, callback ) {

		if ( jQuery.isArray( fieldName ) )
			for ( var i = 0; i < fieldName.length; i++ )
				AS._deletedFieldCallbacks( fieldName[i], callback );

		this._deletedFieldCallbacks[fieldName] = this._deletedFieldCallbacks[fieldName] ? this._deletedFieldCallbacks[fieldName] : []
		this._deletedFieldCallbacks[fieldName].push( callback )

	},

	/**
	 * Fire deletedField callbacks.
	 * Called when a field has been cloned.
	 */
	deletedField: function( el ) {

		// also check child elements
		el.add( el.find( 'div[data-class]' ) ).each( function(i, el) {

			el = jQuery( el )
			var callbacks = AS._deletedFieldCallbacks[el.attr( 'data-class') ]

			if ( callbacks )
				for ( var a = 0; a < callbacks.length; a++ )
					callbacks[a]( el )

		})
	},
	
	sortableInit : function( field ) {

		var items = field.find(' > .field-item').not('.hidden');
		
		field.find( '> .field-item > .as-handle' ).remove();

		items.each( function() {
			jQuery(this).append( '<div class="as-handle"></div>' );
		} );
		
		field.sortable( { 
			handle: "> .as-handle" ,
			cursor: "move",
			items: " > .field-item",
			beforeStop: function( event, ui ) { AS.sortStart( jQuery( ui.item[0] ) ); },
			deactivate: function( event, ui ) { AS.sortEnd( jQuery( ui.item[0] ) ); },
		} );
		
	},

	sortStart : function ( el ) {
		
		// also check child elements
		el.add( el.find( 'div[data-class]' ) ).each( function(i, el) {
		
			el = jQuery( el )
			var callbacks = AS._sortStartCallbacks[el.attr( 'data-class') ]
		
			if ( callbacks )
				for ( var a = 0; a < callbacks.length; a++ )
					callbacks[a]( el )
				
		})

	},

	addCallbackForSortStart: function( fieldName, callback ) {
		
		if ( jQuery.isArray( fieldName ) )
			for ( var i = 0; i < fieldName.length; i++ )
				AS.addCallbackForSortStart( fieldName[i], callback );
	
		this._sortStartCallbacks[fieldName] = this._sortStartCallbacks[fieldName] ? this._sortStartCallbacks[fieldName] : []
		this._sortStartCallbacks[fieldName].push( callback )
	
	},

	sortEnd : function ( el ) {

		// also check child elements
		el.add( el.find( 'div[data-class]' ) ).each( function(i, el) {
		
			el = jQuery( el )
			var callbacks = AS._sortEndCallbacks[el.attr( 'data-class') ]
		
			if ( callbacks )
				for ( var a = 0; a < callbacks.length; a++ )
					callbacks[a]( el )
				
		})

	},

	addCallbackForSortEnd: function( fieldName, callback ) {

		if ( jQuery.isArray( fieldName ) )
			for ( var i = 0; i < fieldName.length; i++ )
				AS.addCallbackForSortEnd( fieldName[i], callback );
	
		this._sortEndCallbacks[fieldName] = this._sortEndCallbacks[fieldName] ? this._sortEndCallbacks[fieldName] : []
		this._sortEndCallbacks[fieldName].push( callback )
	
	}
	
}

jQuery(document).ready( function() {

	AS.init();
	
	//////////////////////////////////////////
	// POST FORMAT toggling CUSTOM META BOXES
	///////////////////////////////////////////
	
	var quoteMetabox	= jQuery('#quote-settings'),
	    quoteSelect		= jQuery('#post-format-quote'),
    	linkMetabox		= jQuery('#_link_meta_box'),
    	linkSelect		= jQuery('#post-format-link'),
    	audioMetabox	= jQuery('#audio-settings'),
    	audioSelect		= jQuery('#post-format-audio'),
    	videoMetabox	= jQuery('#video-settings'),
    	videoSelect		= jQuery('#post-format-video'),
    	galleryMetabox	= jQuery('#gallery-settings'),
    	gallerySelect	= jQuery('#post-format-gallery'),
		imageMetabox	= jQuery('#image-settings'),
    	imageSelect		= jQuery('#post-format-image'),
    	group			= jQuery('#post-formats-select input'),
		featured		= jQuery('#postimagediv');
		
	
    hideAll(null);	
	
	group.change( function() {
		hideAll(null);		
		
		if(jQuery(this).val() == 'quote') {
			quoteMetabox.css('display', 'block');
			featured.css('display', 'block');
		} else if(jQuery(this).val() == 'link') {
			linkMetabox.css('display', 'block');
			featured.css('display', 'block');
		} else if(jQuery(this).val() == 'audio') {
			audioMetabox.css('display', 'block');
			featured.css('display', 'block');
		} else if(jQuery(this).val() == 'video') {
			videoMetabox.css('display', 'block');
			featured.css('display', 'block');
		} else if(jQuery(this).val() =='gallery') {
		    galleryMetabox.css('display', 'block');
			featured.css('display', 'none');
		} else if(jQuery(this).val() =='image') {
		    imageMetabox.css('display', 'block');
			featured.css('display', 'block');
		}
	});
	
	
	if( quoteSelect.is(':checked') ) {
		quoteMetabox.css('display', 'block');
		featured.css('display', 'block');
	}	
	if( linkSelect.is(':checked') ) {
		linkMetabox.css('display', 'block');
		featured.css('display', 'block');
	}
	if( audioSelect.is(':checked') ) {
		audioMetabox.css('display', 'block');
		featured.css('display', 'block');
	}
	if( videoSelect.is(':checked') ) {
		videoMetabox.css('display', 'block');
		featured.css('display', 'block');
	}
	if( gallerySelect.is(':checked') ) {
		galleryMetabox.css('display', 'block');
		featured.css('display', 'none');
	}
	if( imageSelect.is(':checked') ) {
		imageMetabox.css('display', 'block');
		featured.css('display', 'block');
	}
   
   function hideAll(notThisOne) {
		videoMetabox.css('display', 'none');
		quoteMetabox.css('display', 'none');
		linkMetabox.css('display', 'none');
		audioMetabox.css('display', 'none');
		galleryMetabox.css('display', 'none');
		imageMetabox.css('display', 'none');
    }
	
	jQuery('#post-formats-select').prependTo('#post-format-tabs .inside');
	// place meta box before standard post edit field
	
	if( document.getElementById('postdiv') ) {
		jQuery('#post-format-tabs').insertBefore('#postdiv');
	}else if( document.getElementById('postdivrich') ){
		jQuery('#post-format-tabs').insertBefore('#postdivrich');
	} 
	jQuery('#formatdiv').css('display','none');
	// end POST FORMAT toggling CUSTOM META BOXES

});
