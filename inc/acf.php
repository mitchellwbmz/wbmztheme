<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/* Create ACF option pages with capability */
if( function_exists('acf_add_options_sub_page') ){
    acf_add_options_sub_page(array(
        'title' => 'Sidebars',
        'capability' => 'administrator'
    ));
    acf_add_options_sub_page(array(
        'title' => 'Header',
        'capability' => 'administrator'
    ));
    acf_add_options_sub_page(array(
        'title' => 'Social',
        'capability' => 'administrator'
    ));
    acf_add_options_sub_page(array(
        'title' => '404',
        'capability' => 'administrator'
    ));
    acf_add_options_sub_page(array(
        'title' => 'Footer',
        'capability' => 'administrator'
    ));
    if (get_field('maps_script_laden','options')):
     acf_add_options_sub_page(array(
        'title' => 'Maps',
        'capability' => 'administrator'
    ));
    endif;
    acf_add_options_sub_page(array(
        'title' => 'Extra',
        'capability' => 'administrator'
    ));
    acf_add_options_sub_page(array(
        'title' => 'Styling',
        'capability' => 'administrator'
    ));
}
