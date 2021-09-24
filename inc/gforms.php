<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'gform_currencies', function( $currencies ) {
    $currencies['EUR']['symbol_left'] = '&#8364;';
    $currencies['EUR']['symbol_right'] = '';
    $currencies['EUR']['thousand_separator'] = '.';
    $currencies['EUR']['decimal_separator'] = ',';

    return $currencies;
} );
