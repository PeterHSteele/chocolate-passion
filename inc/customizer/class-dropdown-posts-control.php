<?php 

/**
* Class for rendering a custom control for the customizer - a 'dropdown-pages'-like control for posts.
*
* @package chocolate-passion
*/
function chocolate_passion_dropdown_posts(){

	class Chocolate_Passion_Dropdown_Posts_Control extends WP_Customize_Control{
		public $type = 'dropdown-posts';

		public function render_content(){
			$posts = array_merge( get_posts( array( 'numberposts' => -1 )), get_pages() );
			?>
			<label>
				<span class="dropdown-posts-text customize-control-title">
					<?php echo esc_html($this->label); ?>
				</span>
				<select <?php $this->link() ?>>
					<option value="0"><?php esc_html_e( 'None (default)' , 'chocolate-passion' ) ?></option>
				<?php foreach ( $posts as $post ) : ?>
					<option value="<?php echo esc_attr($post->ID); ?>"><?php echo esc_html( get_the_title( $post ) )?></option>
				<?php endforeach; ?>
				</select>
			</label>
			<?php
		}
	}

}

add_action( 'customize_register', 'chocolate_passion_dropdown_posts', 1, 0 );