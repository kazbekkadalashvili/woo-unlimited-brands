<?php

/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class Woo_UB_Brands_List_Widget extends WP_Widget {

	/**
	 * Constructor
	 *
	 * @return void
	 */
	function __construct() {
		$widget_ops = array( 'classname' => 'widget_brands_filter', 'description' => '' );
		parent::__construct( 'widget_brands_filter', 'Brands List', $widget_ops );
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array  An array of standard parameters for widgets in this theme
	 * @param array  An array of settings for this widget instance
	 * @return void Echoes it's output
	 */
	function widget( $args, $instance ) {
		$i = 0;
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];

		$categorys = get_terms( 'brands', array(
									'hide_empty' => false,
								) );
		echo '<ul>';

		foreach ((array)$categorys as $category) {
			if (is_object($category)) {
				$i++;
				$cat_id = $category->term_id;
				$cat_name = $category->name;
				$cat_slug = $category->slug;
				
				if (!isset($_GET['brand'])) {
					$url_brand = esc_url( add_query_arg( array('brand' => $cat_id)) );
					echo '<li><a href="' . $url_brand . '">' . $cat_name .'</a></li>';
				}
				else{
					$brand = explode(',', $_GET['brand']);
					if (in_array($cat_id, $brand)) {
						$count_brend = count($brand);
						$search = array_search($cat_id, $brand);
						if ($search == 0 AND $count_brend == 1) {
							$url_brand = esc_url( add_query_arg( array('brand' => false)) );
						}
						if ($search == 0 AND $count_brend > 1 ) {
							$brands = str_replace( $cat_id . ',', '' ,$_GET['brand']);
							$url_brand = esc_url( add_query_arg( array('brand' => $brands)) );
						}
						if( $search !== 0 AND $count_brend > 1 ){
							$brands = str_replace( ',' . $cat_id, '' ,$_GET['brand']);
							$url_brand = esc_url( add_query_arg( array('brand' => $brands)) );
						}
						
						echo '<li class="sel"><a href="' . $url_brand . '">' . $cat_name .'</a></li>';
					}
					else{
						$brands = $_GET['brand'] . ',' . $cat_id;
						$url_brand = esc_url( add_query_arg( array('brand' => $brands)) );
						echo '<li><a href="' . $url_brand . '">' . $cat_name .'</a></li>';
					}
					
				}
			}

		}
		?>
		<?php		
		echo '</ul>';
		echo $args['after_widget'];
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 *
	 * @param array  An array of the current settings for this widget
	 * @return void Echoes it's output
	 */
	function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php  
	}

	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 *
	 * @param array  An array of new settings as submitted by the admin
	 * @param array  An array of the previous settings
	 * @return array The validated and (if necessary) amended settings
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		return $instance;
	}
}

function woo_ub_register_widget() {
	register_widget( 'Woo_UB_Brands_List_Widget' );
}
add_action( 'widgets_init', 'woo_ub_register_widget' );
