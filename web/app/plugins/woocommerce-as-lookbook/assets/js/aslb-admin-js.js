jQuery(function() {
			
	jQuery( "ul.lookbook-list" ).sortable({
		connectWith: "ul.prod-list",
		start: function(e, ui){
			ui.placeholder.height(ui.item.height());
		},
		stop: function () {
		
			getIDs( jQuery(this) );
			
		},
		placeholder: "sortable-placeholder"
	});

	jQuery( "ul.lookbook-list" ).on( "sortreceive",
		function( event, ui ) {
			
			getIDs( jQuery(this) );
		
		}
	);
	
	function getIDs( ids_holder ) {
		var ids_string 	= '',
			add			= '',
			total		= ids_holder.find('li').length;
		
		ids_holder.find('li').each(
			function( index, element ) {
				add = ( (total-1) == index ) ? '' : ',';
				ids_string += jQuery(this).attr('id') + add;
			}
		);
		jQuery('input#product_ids').val( ids_string );
		
	}
	
	
	jQuery( "ul.prod-list" ).sortable({
		appendTo:		document.body,
		connectWith:	"ul.lookbook-list",
		start: function(e, ui){
			ui.placeholder.height(ui.item.height());
		},
		dropOnEmpty:	true,
		placeholder:	"sortable-placeholder",
		helper:			'original',
		opacity:		0.5,
		scrollSpeed:	400
	});

	jQuery( "#sortable1, #sortable2" ).disableSelection();
});