(function($){
    let container, menu, links, i, len;

    const button = $(".menu-toggle"),
          navigation = $(".main-navigation"),
          navContainer = $(".main-navigation > div > ul, .main-navigation > div#primary-menu"),
          primaryNavLink = $(".main-navigation > div > ul a"),
          searchToggle = $(".search-toggle"),
          searchForm = $(".search-form"),
          lisWithSubmenus = $('.menu-item-has-children'),
          searchInput = $('.banner-header .site-header .search-form input'),
          searchFormControls = $(
            ".banner-header .site-header .search-form .search-term," +
            ".banner-header .site-header .search-form button"
          ),
          searchClose = $(".searchbar-close");   

  // Hide menu toggle button if menu is empty and return early.
  if ( ! navContainer ){
    button.attr("style","display: none;");
    return;
  }

  //Hides the search form in banner-header template
  const cpCloseSearch = function(){
    searchForm.removeClass("toggled").attr('aria-expanded',false);
  }

  const cpOpenSearch = function(){
    searchForm.addClass("toggled").attr('aria-expanded',true);
  }

  //expands primary menu
  const expandMenu = function(){
    button.attr("aria-pressed",true);
    
    navContainer.slideUp(0, function(){
      navContainer.removeClass('accessible-hide')
      navContainer.slideDown(200).attr('aria-expanded',true);
    });
  }

  //hides primary menu
  const hideMenu = function(){
    button.attr("aria-pressed",false);
    navContainer.slideUp(200,function(){
      navContainer.addClass('accessible-hide').slideDown(0).attr('aria-expanded',false);
    });
  }

  //hides or expands primary menu based on current state
  const toggleMenu = function(){
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
  $(document).on('focus','.main-navigation a',null,function(e){
    const isHidden = navContainer.hasClass("accessible-hide"),
          clientWidth = document.getElementsByTagName('body')[0].clientWidth;

    if ( isHidden && clientWidth < 1024 || isHidden && template.bannerHeader == true ){
      expandMenu();
    }
  });

  //handle clicks on the search toggle and search close buttons in banner-header.php
  searchToggle.click(function(){
    if ( searchForm.hasClass('toggled') ){
      cpCloseSearch();
    } else{
      cpOpenSearch()
    }
  });

  //bring off-screen search form on screen when input is focused in banner-header.php
  searchFormControls.focus(function(){
    if (!searchForm.hasClass("toggled")){
      cpOpenSearch();
    }
  });

  //hide search form when its last focusable element blurs
  searchFormControls.blur(function(){
    cpCloseSearch();
  })

  searchClose.click(function(){
    cpCloseSearch();
  });

  //add aria role to submenu parents
  lisWithSubmenus.attr( 'aria-haspopup', true );  

  // Get all the link elements within the menu.
  links = $(".main-navigation ul a");

  // Each time a menu link is focused or blurred, toggle focus.

  function toggleFocus( ele ) {
    while ( ! ele.hasClass("nav-menu") ){
      if ( ele.is( "li" ) ){
        if ( ele.hasClass( "focus" ) ){
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