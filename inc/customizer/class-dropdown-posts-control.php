<?php 

/**
* Class for rendering a new custom control for the customizer - a 'dropdown-pages'-like control for posts.
*
* @package chocolate-passion
*/
function chocolate_passion_dropdown_posts(){

	class WP_Dropdown_Posts_Control extends WP_Customize_Control{
		public $type = 'dropdown-posts';

		public function render_content(){
			$posts = get_posts( -1 );
			?>	
			<select <?php $this->link() ?>>
			<?php foreach ( $posts as $post ) : ?>
				<option  <?php ?> value="<?php echo $post->ID; ?>"><?php echo get_the_title( $post )?></option>
			<?php endforeach; ?>
			</select>
			<?php
		}
	}

}

add_action( 'customize_register', 'chocolate_passion_dropdown_posts', 1, 0 );