jQuery(document).ready(function($){
	let button = $('.menu-toggle'),
		navigation = $('.main-navigation');
		navContainer = $('.menu-primary-container ul'),
		searchToggle = $('.search-toggle'),
		searchForm 	 = $('.search-form'),
		searchClose  = $('#searchbar-close');
	
	button.click(function(){
		if ( navigation.hasClass('toggled') ){
			navigation.removeClass('toggled')
			navigation.attr('aria-expanded',false);
			button.attr('aria-pressed','false');
			navContainer.slideUp(200);
		} else {
			navigation.addClass('toggled')
			navigation.attr('aria-expanded',true);
			button.attr('aria-pressed','true');
			navContainer.slideDown(200);
		}
	});

	searchToggle.click(function(){
		searchForm.addClass('toggled');
	})

	searchClose.click(function(){
		searchForm.removeClass('toggled');
	})

	$(window).resize(function(){
		$('.main-navigation ul').attr( 'style', '' );
		navigation.removeClass( 'toggled' )
	});

	
});

const BinarySearchTree = function( root = null ){
		this.root = root;

		this.depthFirstInOrder = function( node = this.root ){
			if ( ! this.root ){
				return false;
			}

			let leftValues = [],
				rightValues = []

			if ( node.left ){
				 leftValues = this.depthFirstInOrder( node.left )
			}

			if ( node.right ){
				rightValues = this.depthFirstInOrder( node.right )
			}

			return leftValues.concat(node.value).concat(rightValues);
		}
	}

