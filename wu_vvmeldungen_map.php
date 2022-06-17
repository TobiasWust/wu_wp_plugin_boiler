<?php
/**
 * @package wu_wp_plugin_boiler
 */
/*
Plugin Name: wu_vvmeldungen_map
Version: 0.1
Author: Tobias Wust
Author URI: https://www.tobiaswust.de/
Description: show map with markers vor vv meldungen
*/

function wu_load_assets() {
  wp_enqueue_style( 'wu_boiler_style', plugin_dir_url( __FILE__ ) . 'assets/wu_vvmeldungen_map.css' );
}

add_action( 'wp_enqueue_scripts', 'wu_load_assets' );

add_shortcode( 'themeprefix_multiple_marker', 'themeprefix_multiple_marker' );
function themeprefix_multiple_marker() {
        ob_start();
        $args = array(
                'post_type'      => 'meldungen',
                'posts_per_page' => -1,
	);

        $the_query = new WP_Query($args);

        echo "<div class='map-container'><div class='wrap'><div class='acf-map'>";

        while ( $the_query->have_posts() ) : $the_query->the_post();

        $location = get_field('location');
        $title = get_the_title(); // Get the title

        if( !empty($location) ) {
        ?>
        	<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                        <h4><a href="<?php the_permalink(); ?>" rel="bookmark"> <?php the_title(); ?></a></h4>
                        <p class="address"><?php echo $location['address']; ?></p>
        	</div>
	<?php
        }
        endwhile;
        echo '</div></div></div>';
        wp_reset_postdata();
  return ob_get_clean();
}
