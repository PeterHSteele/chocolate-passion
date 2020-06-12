<?php

/** 
*renders a searchbar
*
* @package chocolate-passion
*/

?>

<form method='get' class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label>
			<span class="screen-reader-text"><?php esc_html_e( 'Search for:' , 'chocolate-passion'); ?></span>
			<input type='text' required class="search-term" placeholder="<?php esc_attr_e( 'search', 'chocolate-passion') ?>" name='s'>
		</label>
		<button type="submit" aria-pressed="false">
			<i class="fas fa-search"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Submit search form', 'chocolate-passion' ); ?></span>
		</button>
		<button type="button" aria-hidden="true" class="searchbar-close toggler">
			<i class="fas fa-times fa-lg"></i>
		</button>
</form> 
