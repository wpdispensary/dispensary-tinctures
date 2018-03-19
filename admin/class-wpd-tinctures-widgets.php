<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.wpdispensary.com/
 * @since      1.0.0
 *
 * @package    WPD_Tinctures
 * @subpackage WPD_Tinctures/admin
 */

/**
 * WP Dispensary Tinctures Widget
 *
 * @since       1.0.0
 */
class wpd_tinctures_widget extends WP_Widget {

	/**
	 * Constructor
	 *
	 * @access      public
	 * @since       1.0.0
	 * @return      void
	 */
	public function __construct() {

		parent::__construct(
			'wpd_tinctures_widget',
			__( 'Dispensary Tinctures', 'wp-dispensary' ),
			array(
				'description' => __( 'Your most recent Tinctures', 'wp-dispensary' ),
				'classname'   => 'wp-dispensary-widget',
			)
		);

	}

	/**
	 * Widget definition
	 *
	 * @access      public
	 * @since       1.0.0
	 * @see         WP_Widget::widget
	 * @param       array $args Arguments to pass to the widget.
	 * @param       array $instance A given widget instance.
	 * @return      void
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['id'] ) ) {
			$args['id'] = 'wpd_tinctures_widget';
		}

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $args['id'] );

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}

		do_action( 'wpd_tinctures_widget_before' );

		if ( ! 'on' == $instance['featuredimage'] ) {
			echo "<ul class='wpdispensary-list'>";
		}

		if ( 'on' === $instance['order'] ) {
			$randorder = 'rand';
		} else {
			$randorder = '';
		}

		global $post;

		$wpd_tinctures_widget = new WP_Query(
			array(
				'post_type' => 'tinctures',
				'showposts' => $instance['limit'],
				'orderby'   => $randorder,
			)
		);

		while ( $wpd_tinctures_widget->have_posts() ) :
			$wpd_tinctures_widget->the_post();

			$do_not_duplicate = $post->ID;

			if ( 'on' === $instance['featuredimage'] ) {

				echo "<div class='wpdispensary-widget'>";
				do_action( 'wpd_tinctures_widget_inside_top' );
				echo "<a href='" . esc_url( get_permalink( $post->ID ) ) . "'>";
					the_post_thumbnail( $instance['imagesize'] );
				echo '</a>';
				if ( 'on' === $instance['tincturesname'] ) {
					echo "<span class='wpdispensary-widget-title'><a href='" . esc_url( get_permalink( $post->ID ) ) . "'>" . get_the_title( $post->ID ) . "</a></span>";
				}
				if ( 'on' === $instance['tincturescategory'] ) {
					echo "<span class='wpdispensary-widget-categories'>" . get_the_term_list( $post->ID, 'wpd_tinctures_category' ) . "</a></span>";
				}
				do_action( 'wpd_tinctures_widget_inside_bottom' );
				echo '</div>';

			} else {

				echo '<li>';
				if ( 'on' === $instance['tincturesname'] ) {
					echo "<a href='" . esc_url( get_permalink( $post->ID ) ) . "' class='wpdispensary-widget-link'>" . get_the_title( $post->ID ) . "</a>";
				}
				echo '</li>';

			}

		endwhile; // End loop.

		wp_reset_postdata();

		if ( ! 'on' == $instance['featuredimage'] ) {
			echo '</ul>';
		}

		do_action( 'wpd_tinctures_widget_after' );

		echo $args['after_widget'];
	}


	/**
	 * Update widget options
	 *
	 * @access      public
	 * @since       1.0.0
	 * @see         WP_Widget::update
	 * @param       array $new_instance The updated options.
	 * @param       array $old_instance The old options.
	 * @return      array $instance The updated instance options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']             = strip_tags( $new_instance['title'] );
		$instance['limit']             = strip_tags( $new_instance['limit'] );
		$instance['order']             = $new_instance['order'];
		$instance['featuredimage']     = $new_instance['featuredimage'];
		$instance['imagesize']         = $new_instance['imagesize'];
		$instance['tincturesname']     = $new_instance['tincturesname'];
		$instance['tincturescategory'] = $new_instance['tincturescategory'];

		return $instance;
	}


	/**
	 * Display widget form on dashboard
	 *
	 * @access      public
	 * @since       1.0.0
	 * @see         WP_Widget::form
	 * @param       array $instance A given widget instance.
	 * @return      void
	 */
	public function form( $instance ) {
		$defaults = array(
			'title'             => 'Recent Tinctures',
			'limit'             => '5',
			'order'             => '',
			'featuredimage'     => '',
			'imagesize'         => 'wpdispensary-widget',
			'tincturesname'     => '',
			'tincturescategory' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'wp-dispensary' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_html( $instance['title'] ); ?>" />
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php esc_html_e( 'Amount of tinctures to show:', 'wp-dispensary' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" type="number" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" min="1" max="999" value="<?php echo esc_html( $instance['limit'] ); ?>" />
	</p>

	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['order'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Randomize output?', 'wp-dispensary' ); ?></label>
	</p>

	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['tincturesname'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'tincturesname' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tincturesname' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'tincturesname' ) ); ?>"><?php esc_html_e( 'Display tinctures name?', 'wp-dispensary' ); ?></label>
	</p>

	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['tincturescategory'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'tincturescategory' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tincturescategory' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'tincturescategory' ) ); ?>"><?php esc_html_e( 'Display tinctures category?', 'wp-dispensary' ); ?></label>
	</p>

	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['featuredimage'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'featuredimage' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'featuredimage' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'featuredimage' ) ); ?>"><?php esc_html_e( 'Display featured image?', 'wp-dispensary' ); ?></label>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'imagesize' ) ); ?>"><?php esc_html_e( 'Image size:', 'wp-dispensary' ); ?></label>
		<?php
			$terms = array( 'wpdispensary-widget', 'dispensary-image', 'wpd-small', 'wpd-medium', 'wpd-large' );
		if ( $terms ) {
			printf( '<select name="%s" id="' . esc_html( $this->get_field_id( 'imagesize' ) ) . '" name="' . esc_html( $this->get_field_name( 'imagesize' ) ) . '" class="widefat">', esc_attr( $this->get_field_name( 'imagesize' ) ) );
			foreach ( $terms as $term ) {
				if ( esc_html( $term ) != $instance['imagesize'] ) {
					$imagesizeinfo = '';
				} else {
					$imagesizeinfo = 'selected="selected"';
				}
				printf( '<option value="%s" ' . esc_html( $imagesizeinfo ) . '>%s</option>', esc_html( $term ), esc_html( $term ) );
			}
			print( '</select>' );
		}
		?>
	</p>

	<?php
	}
}

/**
 * Register the new widget
 *
 * @since       1.0.0
 * @return      void
 */
function wpd_tinctures_register_widget() {
	register_widget( 'wpd_tinctures_widget' );
}
add_action( 'widgets_init', 'wpd_tinctures_register_widget' );
