<?php
/*
	Plugin Name: ARI Stream Quiz
	Plugin URI: http://wp-quiz.ari-soft.com
	Description: Powerful and easy to use quiz plugin for WordPress.
	Version: 1.2.25
	Author: ARI Soft
	Author URI: http://www.ari-soft.com
	Text Domain: ari-stream-quiz
	Domain Path: /languages
	License: GPL2
 */

defined( 'ABSPATH' ) or die( 'Access forbidden!' );

define( 'ARISTREAMQUIZ_URL', plugin_dir_url( __FILE__ ) );
define( 'ARISTREAMQUIZ_PATH', plugin_dir_path( __FILE__ ) );

if ( ! function_exists( 'ari_stream_quiz_activation_check' ) ) {
    function ari_stream_quiz_activation_check() {
        $min_php_version = '5.4.0';
        $min_wp_version = '4.0.0';

        $current_wp_version = get_bloginfo( 'version' );
        $current_php_version = PHP_VERSION;

        $is_supported_php_version = version_compare( $current_php_version, $min_php_version, '>=' );
        $is_spl_installed = function_exists( 'spl_autoload_register' );
        $is_supported_wp_version = version_compare( $current_wp_version, $min_wp_version, '>=' );

        if ( ! $is_supported_php_version || ! $is_spl_installed || ! $is_supported_wp_version ) {
            deactivate_plugins( basename( __FILE__ ) );

            $recommendations = array();

            if ( ! $is_supported_php_version )
                $recommendations[] = sprintf(
                    __( 'update PHP version on your server from v. %s to at least v. %s', 'ari-stream-quiz' ),
                    $current_php_version,
                    $min_php_version
                );

            if ( ! $is_spl_installed )
                $recommendations[] = __( 'install PHP SPL extension', 'ari-stream-quiz' );

            if ( ! $is_supported_wp_version )
                $recommendations[] = sprintf(
                    __( 'update WordPress v. %s to at least v. %s', 'ari-stream-quiz' ),
                    $current_wp_version,
                    $min_wp_version
                );

            wp_die(
                sprintf(
                    __( '"ARI Stream Quiz" can not be activated. It requires PHP version 5.4.0+ with SPL extension and WordPress 4.0+.<br /><br /><b>Recommendations:</b> %s.<br /><br /><a href="%s" class="button button-primary">Back</a>', 'ari-stream-quiz' ),
                    join( ', ', $recommendations ),
                    get_dashboard_url()
                )
            );
        } else {
            ari_stream_quiz_init();
        }
    }
}

if ( version_compare( PHP_VERSION, '5.4.0', '>=' ) ) {
    require_once ARISTREAMQUIZ_PATH . 'loader.php';

    add_action( 'plugins_loaded', 'ari_stream_quiz_init' );
}


register_activation_hook( __FILE__, 'ari_stream_quiz_activation_check' );
