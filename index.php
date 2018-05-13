<?php
/**
 * Plugin Name: Unlimited Brands for WooCommerce
 * Description: Woocommerce Brands Plugin. You can assign poducts to brands. There's shortcode to display list of brands, as well as widget that provides filter form for brands.
 * Plugin URI: http://wordpress.org
 * Author: Kazbek Kadalashvili
 * Author URI: http://kazbek.co
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: woo-ub
 */


/*
    Copyright (C) 2018  Kadalashvili Kazbek  kazbek.kadalashvili@gmail.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	include dirname(__FILE__) . '/includes/taxonomy.php';

	include dirname(__FILE__) . '/includes/taxonomy-field.php';

	include dirname(__FILE__) . '/includes/shortcode.php';

    include dirname(__FILE__) . '/includes/functions.php';

	include dirname(__FILE__) . '/includes/widget/widget-list-brands.php';


	/**
	 * Enqueue scripts
	 *
	 * @param string $handle Script name
	 * @param string $src Script url
	 * @param array $deps (optional) Array of script names on which this script depends
	 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
	 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
	 */
	function woo_ub_style() {
		wp_enqueue_script( 'slick-js', plugin_dir_url( __FILE__ ) . 'assets/slick/slick.js', array( 'jquery' ), false, true );
		wp_register_script( 'main-js', plugin_dir_url( __FILE__ ) . 'assets/js/main.js', array( 'jquery' ), false, true );
	    wp_enqueue_style( 'slick-theme', plugin_dir_url( __FILE__ ) . 'assets/slick/slick-theme.css');
	    wp_enqueue_style( 'slick-logo-css', plugin_dir_url( __FILE__ ) . 'assets/css/infinite-slider.css');
	    wp_enqueue_style( 'brands-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css');
	}
	add_action( 'wp_enqueue_scripts', 'woo_ub_style' );


function woo_ub_product_filter( $query ) {
    if ( (is_post_type_archive( 'product' ) OR is_product_category()) AND !empty($_GET['brand'])) {
        global $wp_query;
        $brands = explode(',', $_GET['brand']);
        $query->set('tax_query', array(
        	array(
            'taxonomy' => 'brands',
        	'operator' => 'IN',
            'terms' => $brands,
            'field'    => 'id'
        ) )
        );
        return;
        
    }
}
add_action( 'pre_get_posts', 'woo_ub_product_filter', 1 );

}
