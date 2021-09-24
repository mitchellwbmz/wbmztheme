<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'facetwp_is_main_query', function( $is_main_query, $query ) {
    if ( '' !== $query->get( 'facetwp' ) ) {
        $is_main_query = (bool) $query->get( 'facetwp' );
    }
    return $is_main_query;
}, 10, 2 );

add_filter( 'facetwp_result_count', function( $output, $params ) {
    $output = $params['total'];
    strip_tags($output);
    return $output;
}, 10, 2 );

add_filter( 'facetwp_proximity_store_distance', '__return_true' );
