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
			$posts = get_posts( array( 'numberposts' => -1 ) );
			?>
			<label>
				<span style="font-weight: 600" class="dropdown-posts-text">
					<?php esc_html_e( 'Post to include in homepage slideshow', 'chocolate-passion' ); ?>
				</span>
				<select <?php $this->link() ?>>
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