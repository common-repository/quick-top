<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function quick_top_enqueue_scripts() {
    $options = get_option( 'quick_top_settings' );

    if ( isset( $options['enabled'] ) && $options['enabled'] ) {
        // Register and enqueue the JavaScript
        wp_register_script( 'quick-top-js', plugins_url( '/js/quick-top.js', __FILE__ ), array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'quick-top-js' );

        // Inline script
        $scroll_distance = isset($options['scroll_distance']) ? esc_attr($options['scroll_distance']) : 100;
        wp_add_inline_script( 'quick-top-js', "
            jQuery(document).ready(function($) {
                var quickTop = $('#quick-top');
                $(window).scroll(function() {
                    if ($(this).scrollTop() > $scroll_distance) {
                        quickTop.fadeIn();
                    } else {
                        quickTop.fadeOut();
                    }
                });
                quickTop.click(function() {
                    $('html, body').animate({ scrollTop: 0 }, 600);
                    return false;
                });
            });
        ");

        // Inline CSS
        $position = isset( $options['position'] ) ? $options['position'] : 'bottom-right';
        $border_radius = isset( $options['border_radius'] ) ? intval($options['border_radius']) . 'px' : '50%';
        $icon_bg_color = isset($options['icon_bg_color']) ? esc_attr($options['icon_bg_color']) : '#000';
        $icon_color = isset($options['icon_color']) ? esc_attr($options['icon_color']) : '#fff';
        $icon_size = isset($options['icon_size']) ? intval($options['icon_size']) . 'px' : '24px';
        $bg_width = isset($options['bg_width']) ? intval($options['bg_width']) . 'px' : '50px';
        $bg_height = isset($options['bg_height']) ? intval($options['bg_height']) . 'px' : '50px';
        $padding = isset($options['padding']) ? intval($options['padding']) . 'px' : '10px';
        $margin_top = isset($options['margin_top']) ? intval($options['margin_top']) . 'px' : '0';
        $margin_right = isset($options['margin_right']) ? intval($options['margin_right']) . 'px' : '0';
        $margin_bottom = isset($options['margin_bottom']) ? intval($options['margin_bottom']) . 'px' : '0';
        $margin_left = isset($options['margin_left']) ? intval($options['margin_left']) . 'px' : '0';
        
        $position_styles = '';
        switch ($position) {
            case 'bottom-right':
                $position_styles = 'bottom: 20px; right: 20px;';
                break;
            case 'bottom-left':
                $position_styles = 'bottom: 20px; left: 20px;';
                break;
            case 'top-right':
                $position_styles = 'top: 20px; right: 20px;';
                break;
            case 'top-left':
                $position_styles = 'top: 20px; left: 20px;';
                break;
        }

        $style = "
            #quick-top {
                position: fixed;
                display: none;
                $position_styles
                background-color: $icon_bg_color;
                color: $icon_color;
                font-size: $icon_size;
                width: $bg_width;
                height: $bg_height;
                padding: $padding;
                margin-top: $margin_top;
                margin-right: $margin_right;
                margin-bottom: $margin_bottom;
                margin-left: $margin_left;
                border-radius: $border_radius;
            }
        ";

        wp_register_style( 'quick-top-css', false, array(), '1.0.0' );
        wp_enqueue_style( 'quick-top-css' );
        wp_add_inline_style( 'quick-top-css', $style );

        if ( isset( $options['mobile_enabled'] ) && !$options['mobile_enabled'] ) {
            $hide_mobile_style = '@media (max-width: 768px) { #quick-top { display: none !important; } }';
            wp_add_inline_style( 'quick-top-css', $hide_mobile_style );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'quick_top_enqueue_scripts' );

function quick_top_display_button() {
    $options = get_option( 'quick_top_settings' );

    if ( isset( $options['enabled'] ) && $options['enabled'] ) {
        echo '<div id="quick-top" data-scroll-distance="' . esc_attr($options['scroll_distance']) . '"><i class="fa ' . esc_attr($options['icon']) . '"></i></div>';
    }
}
add_action( 'wp_footer', 'quick_top_display_button' );
?>