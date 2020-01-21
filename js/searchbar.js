jQuery(document).ready(function($){
	let button = $('.menu-toggle'),
		navigation = $('.main-navigation');
		navContainer = $('.menu-primary-container ul');
	button.click(function(){
		console.log('click')
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
	})
});

( function(){

	let searchToggle = document.getElementsByClassName('search-toggle')[0],
		menuToggle	 = document.getElementsByClassName('menu-toggle')[0],
		searchIcon	 = document.querySelector('.search-toggle i'),
		form 		 = document.getElementsByClassName('search-form')[0],
		searchbar	 = document.getElementsByClassName('header-search')[0],
		navigation 	 = document.getElementsByClassName('main-navigation')[0],
		searchClose	 = document.getElementById('searchbar-close');
		mainNavList	 = navigation.getElementsByTagName('ul')[0];


	function handleNavToggleClick(){
		removeActive( searchbar )
		changeActive( navigation );
	}

	function handleSearchToggleClick(){
		changeActive( searchbar );
		toggleDisplay( searchToggle );
	}

	function toggleDisplay( ui ){
		if (ui.className.search('no-display') > -1){
			window.setTimeout(function(){ 
				removeClass( ui, 'no-display' )
			}, 200);
		} else {
			ui.className += ' no-display';
		}
	}

	function removeClass( ui, name ){
		ui.className = ui.className.replace( ' ' + name, '');
	}

	function changeActive( ui ){
		if ( ui.className.search( 'active' ) > -1 ){
			removeClass( ui, 'expanded' )
			window.setTimeout(function(){removeClass(ui, 'active')}, 200);
		} else {
			ui.className = ui.className.concat( ' active expanded' );
		}
	}

	function handleResize(){
		mainNavList.style = '';
		removeClass( searchbar, 'active' );
		removeClass( searchbar, 'expanded' );
		removeClass( searchToggle, 'no-display' );
		removeClass( navigation, 'toggled' );
	}
	/*
	let togglers = document.getElementsByClassName( 'toggler' );
	for (let i; i < togglers.length; i++ ){

	}
*/
	

	//menuToggle.addEventListener( 'click', handleNavToggleClick );
	window.addEventListener('resize', handleResize);
	searchToggle.addEventListener( 'click', handleSearchToggleClick );
	searchClose.addEventListener( 'click', handleSearchToggleClick );

}())