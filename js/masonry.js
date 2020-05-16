( function($){
	let posts = $('.site-main').imagesLoaded(function(){

		$('.site-main').masonry({
			itemSelector: '.cp-grid-item',
			columnWidth: '.cp-grid-sizer',
			percentPosition: true,
			horizontalOrder: true,
		});

	})

}( jQuery ) );