(function($){
    let container;
    let menu;
    let links;
    let i;
    let len;

    let button = $(".menu-toggle");
    let navigation = $(".main-navigation");
    let navContainer = $(".main-navigation > div > ul");
    let searchToggle = $(".search-toggle");
    let searchForm = $(".search-form");
    let searchClose = $("#searchbar-close");

  // Hide menu toggle button if menu is empty and return early.
  if ( ! navContainer ){
    button.attr("style","display: none;");
    return;
  }

  //set up attributes and classes on the main nav ul
  navContainer.attr( "aria-expanded", "false" ).addClass("nav-menu");

  //handle clicks on the menu-toggle button
  button.click(function(){
    if ( navigation.hasClass("toggled") ){
      navigation.removeClass("toggled");
      navigation.attr("aria-expanded",false);
      button.attr("aria-pressed","false");
      navContainer.slideUp(200);
    } else {
      navigation.addClass("toggled");
      navigation.attr("aria-expanded",true);
      button.attr("aria-pressed","true");
      navContainer.slideDown(200);
    }
  });

  //handle clicks on the search toggle
  searchToggle.click(function(){
    searchForm.addClass("toggled");
  });

  searchClose.click(function(){
    searchForm.removeClass("toggled");
  });

  $(window).resize(function(){
    $(".main-navigation ul").attr( "style", "" );
    navigation.removeClass( "toggled" );
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