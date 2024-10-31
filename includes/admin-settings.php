<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function quick_top_add_admin_menu() {
    add_menu_page(
        'Quick Top Settings',
        'Quick Top',
        'manage_options',
        'quick-top-settings',
        'quick_top_settings_page',
        'dashicons-arrow-up-alt',
        100
    );
}
add_action( 'admin_menu', 'quick_top_add_admin_menu' );

function quick_top_settings_page() {
    ?>
    <div class="quick-top-wrap">
        <h1>Quick Top Settings</h1>
        <div class="quick-top-admin-container">
            <form id="quick_top_live_preview" method="post" action="options.php" class="quick-top-settings-form">
                <?php
                settings_fields( 'quick_top_settings_group' );
                do_settings_sections( 'quick-top-settings' );
                submit_button();
                ?>
            </form>
            <div class="quick-top-live-preview">
                <h2>Live Preview</h2>
                <div id="quick-top-preview" style="background-color: #000; color: #fff; width: 50px; height: 50px; padding: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="fa fa-arrow-up"></i>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function quick_top_register_settings() {
    register_setting( 'quick_top_settings_group', 'quick_top_settings' );

    add_settings_section(
        'quick_top_main_section',
        'Main Settings',
        'quick_top_main_section_callback',
        'quick-top-settings'
    );

    add_settings_field(
        'quick_top_enable',
        'Enable',
        'quick_top_enable_callback',
        'quick-top-settings',
        'quick_top_main_section'
    );

    add_settings_field(
        'quick_top_border_radius',
        'Border Radius',
        'quick_top_border_radius_callback',
        'quick-top-settings',
        'quick_top_main_section'
    );

    add_settings_field(
        'quick_top_mobile_enable',
        'Enable on Mobile',
        'quick_top_mobile_enable_callback',
        'quick-top-settings',
        'quick_top_main_section'
    );

    add_settings_field(
        'quick_top_icon',
        'Icon',
        'quick_top_icon_callback',
        'quick-top-settings',
        'quick_top_main_section'
    );
    add_settings_field(
        'quick_top_icon_color',
        'Icon Color',
        'quick_top_icon_color_callback',
        'quick-top-settings',
        'quick_top_main_section'
    );
    add_settings_field(
        'quick_top_icon_bg_color',
        'Icon Background Color',
        'quick_top_icon_bg_color_callback',
        'quick-top-settings',
        'quick_top_main_section'
    );
    add_settings_field(
        'quick_top_icon_size',
        'Icon Size',
        'quick_top_icon_size_callback',
        'quick-top-settings',
        'quick_top_main_section'
    );
    add_settings_field(
        'quick_top_bg_width',
        'Background Width',
        'quick_top_bg_width_callback',
        'quick-top-settings',
        'quick_top_main_section'
    );
    add_settings_field(
        'quick_top_bg_height',
        'Background Height',
        'quick_top_bg_height_callback',
        'quick-top-settings',
        'quick_top_main_section'
    );
    add_settings_field(
        'quick_top_padding',
        'Padding',
        'quick_top_padding_callback',
        'quick-top-settings',
        'quick_top_main_section'
    );
    add_settings_field(
        'quick_top_margin',
        'Margin',
        'quick_top_margin_callback',
        'quick-top-settings',
        'quick_top_main_section'
    );
    add_settings_field(
        'quick_top_position',
        'Position',
        'quick_top_position_callback',
        'quick-top-settings',
        'quick_top_main_section'
    );
    add_settings_field(
        'quick_top_scroll_distance',
        'Scroll Distance',
        'quick_top_scroll_distance_callback',
        'quick-top-settings',
        'quick_top_main_section'
    );
}
add_action( 'admin_init', 'quick_top_register_settings' );

function quick_top_main_section_callback() {
    echo 'Customize your Quick Top button.';
}

function quick_top_enable_callback() {
    $options = get_option( 'quick_top_settings' );
    ?>
    <label class="switch">
        <input type="checkbox" name="quick_top_settings[enabled]" value="1" <?php checked( 1, isset( $options['enabled'] ) ? $options['enabled'] : 0 ); ?>>
        <span class="slider round"></span>
    </label>
    <?php
}

function quick_top_border_radius_callback() {
    $options = get_option( 'quick_top_settings' );
    ?>
    <input type="number" name="quick_top_settings[border_radius]" value="<?php echo isset($options['border_radius']) ? esc_attr($options['border_radius']) : ''; ?>" min="0" max="50">
    <span>px</span>
    <?php
}

function quick_top_mobile_enable_callback() {
    $options = get_option( 'quick_top_settings' );
    ?>
    <label class="switch">
        <input type="checkbox" name="quick_top_settings[mobile_enabled]" value="1" <?php checked( 1, isset( $options['mobile_enabled'] ) ? $options['mobile_enabled'] : 0 ); ?>>
        <span class="slider round"></span>
    </label>
    <?php
}

function quick_top_icon_callback() {
    $options = get_option( 'quick_top_settings' );
    ?>
    <select name="quick_top_settings[icon]">
        <option value="fa-arrow-up" <?php selected( $options['icon'], 'fa-arrow-up' ); ?>>Arrow Up</option>
        <option value="fa-arrow-down" <?php selected( $options['icon'], 'fa-arrow-down' ); ?>>Arrow Down</option>
        <option value="fa-arrow-left" <?php selected( $options['icon'], 'fa-arrow-left' ); ?>>Arrow Left</option>
        <option value="fa-arrow-right" <?php selected( $options['icon'], 'fa-arrow-right' ); ?>>Arrow Right</option>
        <option value="fa-chevron-up" <?php selected( $options['icon'], 'fa-chevron-up' ); ?>>Chevron Up</option>
        <option value="fa-chevron-down" <?php selected( $options['icon'], 'fa-chevron-down' ); ?>>Chevron Down</option>
        <option value="fa-chevron-left" <?php selected( $options['icon'], 'fa-chevron-left' ); ?>>Chevron Left</option>
        <option value="fa-chevron-right" <?php selected( $options['icon'], 'fa-chevron-right' ); ?>>Chevron Right</option>
        <!-- Add more options as needed -->
    </select>
    <?php
}

function quick_top_icon_color_callback() {
    $options = get_option( 'quick_top_settings' );
    ?>
    <input type="color" name="quick_top_settings[icon_color]" value="<?php echo isset($options['icon_color']) ? esc_attr($options['icon_color']) : ''; ?>">
    <?php
}

function quick_top_icon_bg_color_callback() {
    $options = get_option( 'quick_top_settings' );
    ?>
    <input type="color" name="quick_top_settings[icon_bg_color]" value="<?php echo isset($options['icon_bg_color']) ? esc_attr($options['icon_bg_color']) : ''; ?>">
    <?php
}

function quick_top_icon_size_callback() {
    $options = get_option( 'quick_top_settings' );
    ?>
    <input type="number" name="quick_top_settings[icon_size]" value="<?php echo isset($options['icon_size']) ? esc_attr($options['icon_size']) : ''; ?>" min="10" max="100">
    <?php
}

function quick_top_bg_width_callback() {
    $options = get_option( 'quick_top_settings' );
    ?>
    <input type="number" name="quick_top_settings[bg_width]" value="<?php echo isset($options['bg_width']) ? esc_attr($options['bg_width']) : ''; ?>" min="10" max="500">
    <?php
}

function quick_top_bg_height_callback() {
    $options = get_option( 'quick_top_settings' );
    ?>
    <input type="number" name="quick_top_settings[bg_height]" value="<?php echo isset($options['bg_height']) ? esc_attr($options['bg_height']) : ''; ?>" min="10" max="500">
    <?php
}

function quick_top_padding_callback() {
    $options = get_option( 'quick_top_settings' );
    ?>
    <input type="number" name="quick_top_settings[padding]" value="<?php echo isset($options['padding']) ? esc_attr($options['padding']) : ''; ?>" min="0" max="100">
    <?php
}

function quick_top_margin_callback() {
    $options = get_option( 'quick_top_settings' );
    ?>
    <input type="number" name="quick_top_settings[margin_top]" placeholder="Top" value="<?php echo isset($options['margin_top']) ? esc_attr($options['margin_top']) : ''; ?>" min="0" max="100">
    <input type="number" name="quick_top_settings[margin_right]" placeholder="Right" value="<?php echo isset($options['margin_right']) ? esc_attr($options['margin_right']) : ''; ?>" min="0" max="100">
    <input type="number" name="quick_top_settings[margin_bottom]" placeholder="Bottom" value="<?php echo isset($options['margin_bottom']) ? esc_attr($options['margin_bottom']) : ''; ?>" min="0" max="100">
    <input type="number" name="quick_top_settings[margin_left]" placeholder="Left" value="<?php echo isset($options['margin_left']) ? esc_attr($options['margin_left']) : ''; ?>" min="0" max="100">
    <?php
}

function quick_top_position_callback() {
    $options = get_option( 'quick_top_settings' );
    ?>
    <select name="quick_top_settings[position]">
        <option value="bottom-right" <?php selected( $options['position'], 'bottom-right' ); ?>>Bottom Right</option>
        <option value="bottom-left" <?php selected( $options['position'], 'bottom-left' ); ?>>Bottom Left</option>
        <option value="top-right" <?php selected( $options['position'], 'top-right' ); ?>>Top Right</option>
        <option value="top-left" <?php selected( $options['position'], 'top-left' ); ?>>Top Left</option>
    </select>
    <?php
}

function quick_top_scroll_distance_callback() {
    $options = get_option( 'quick_top_settings' );
    ?>
    <input type="number" name="quick_top_settings[scroll_distance]" value="<?php echo isset($options['scroll_distance']) ? esc_attr($options['scroll_distance']) : ''; ?>" min="0" max="1000">
    <?php
}
?>
