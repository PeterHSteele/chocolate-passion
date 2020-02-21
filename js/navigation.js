(function($){
    let container;
    let menu;
    let links;
    let i;
    let len;

    let button = $(".menu-toggle");
    let navigation = $(".main-navigation");
    let navContainer = $(".main-navigation > div > ul");
    let primaryNavLink = $(".main-navigation > div > ul a")
    let searchToggle = $(".search-toggle");
    let searchForm = $(".search-form");
    let searchInput = $(".banner-header .search-form #search");
    let searchClose = $("#searchbar-close");

  // Hide menu toggle button if menu is empty and return early.
  if ( ! navContainer ){
    button.attr("style","display: none;");
    return;
  }

  let expandMenu = function(){
    button.attr("aria-expanded",true);
    navContainer.slideUp(0, function(){
      navContainer.removeClass('accessible-hide').slideDown(200).attr('aria-expanded',true);
    });
  }

  let hideMenu = function(){
    button.attr("aria-expanded",false);
    navContainer.slideUp(200,function(){
      navContainer.addClass('accessible-hide').slideDown(0).attr('aria-expanded',false);
    });
  }

  let toggleMenu = function(){
    if (! navContainer.hasClass("accessible-hide") ){
      hideMenu();
    } else {
      expandMenu();
    }
  }

  //handle clicks on the menu-toggle button
  button.click(function(){
    toggleMenu();
  });

  //bring off-screen menus on-screen on when a link is focused
  primaryNavLink.focus(function(){
    if ( navContainer.hasClass("accessible-hide") ){
      expandMenu();
    }
  })

  //handle clicks on the search toggle and search close buttons in banner-header.php
  searchToggle.click(function(){
    if ( searchForm.hasClass('toggled') ){
      searchForm.removeClass('toggled').attr( 'aria-expanded', false);
      searchToggle.attr('aria-expanded', false);
    } else{
      searchForm.addClass("toggled").attr('aria-expanded',true);
      searchToggle.attr('aria-expanded',true);
    }
  });

  //bring off-screen search form on screen when input is focused
  searchInput.focus(function(){
    if (!searchForm.hasClass("toggled")){
      searchForm.addClass("toggled").attr('aria-expanded',true);
      searchToggle.attr('aria-expanded',true);
    }
  })

  searchClose.click(function(){
    searchForm.removeClass("toggled").attr('aria-expanded',false);
    searchToggle.attr('aria-expanded', false);
  });

  //hide search form when its last focusable element blurs
  searchClose.blur(function(){
    searchForm.removeClass("toggled").attr('aria-expanded',false);
    searchToggle.attr('aria-expanded', false);
  });

  // Get all the link elements within the menu.
  links = $(".main-navigation ul a");

  // Each time a menu link is focused or blurred, toggle focus.

  function toggleFocus( ele ) {
    while ( ! ele.hasClass("nav-menu") ){
      if ( ele.is( "li" ) ){
        if ( ele.hasClass("focus") ){
          ele.removeClass(" focus" );
        } else {
          ele.addClass( "focus" );
        }
      }
      ele = ele.parent();
    }
  }

  links.focus(function(){
    toggleFocus($(this));
  });

  links.blur(function(){
    toggleFocus($(this));
  });

  /**
  * Toggles `focus` class to allow submenu access on tablets.
  */

  container = document.getElementsByClassName("main-navigation")[0];

  ( function( container ) {
    let touchStartFn;
    let parentLink = container.querySelectorAll(
      ".menu-item-has-children > a, .page_item_has_children > a"
    );

    if ( "ontouchstart" in window ) {
      touchStartFn = function( e ) {
        let menuItem = this.parentNode;

        if ( ! menuItem.classList.contains( "focus" ) ) {
          e.preventDefault();
          for ( i = 0; i < menuItem.parentNode.children.length; i+=1 ) {
            if ( menuItem === menuItem.parentNode.children[i] ) {
              continue;
            }
            menuItem.parentNode.children[i].classList.remove( "focus" );
          }
          menuItem.classList.add( "focus" );
        } else {
          menuItem.classList.remove( "focus" );
        }
      };

      for ( i = 0; i < parentLink.length; i+=1 ) {
        parentLink[i].addEventListener( "touchstart", touchStartFn, false );
      }
    }
  }( container ) );

})(jQuery);