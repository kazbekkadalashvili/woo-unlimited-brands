<?php


add_action('woocommerce_product_meta_start','woo_ub_add_pet_info' );
function woo_ub_add_pet_info($pet_info) {
    $product_brends = wp_get_post_terms( get_the_ID(), 'brands' );
	
	$arrayKeys = array_keys($product_brends);

	$lastArrayKey = array_pop($arrayKeys);
	
	echo '<div class="brend"><span class="single-product-brends"><p class="lable-brends">Brend: </p>';

    foreach ((array)$product_brends as $key => $value) {
         if (is_object($value)) {
            $brend_id = $value->term_id;
            $brend_name = $value->name;
            if($key == $lastArrayKey) {
            	echo ' <a href="' . get_term_link( $value, 'brend' ) . '">' . $brend_name . '</a>';
            }
            else{
            	echo ' <a href="' . get_term_link( $value, 'brend' ) . '">' . $brend_name . '</a>, ';
            }
            
        }
    }
    echo '<span></div>';

}

