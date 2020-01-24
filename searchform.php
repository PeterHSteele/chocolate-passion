<?php

/** 
*renders a searchbar
*
* @package chocolate-passion
*/

?>

<form method='get' class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="search">
			<span class="screen-reader-text"><?php esc_html_e( 'Search for:' , 'chocolate-passion'); ?></span>
		</label>
		<input type='text' required placeholder="search" id='search' name='s'>
		<button type="submit" role="submit">
			<i class="fas fa-search"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Submit search form', 'chocolate-passion' ); ?></span>
		</button>
		<button type="button" id="searchbar-close" class="toggler">
			<i class="fas fa-times fa-lg"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Close Search', 'chocolate-passion' ); ?></span>
		</button>
</form> 
