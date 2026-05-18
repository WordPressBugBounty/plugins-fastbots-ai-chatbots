<?php
/*
 * Plugin Name:       FastBots
 * Plugin URI:        https://wordpress.org/plugins/fastbots/
 * Description: Easily add your FastBots AI chatbot to your WordPress site.
 * Version:           1.0.13
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            FastBots
 * Author URI:        https://fastbots.ai
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       fastbots
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

define( 'FASTBOTS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once(FASTBOTS_PLUGIN_DIR . 'settings-page.php');

function fastbots_chatbot_to_header() {
    $embed_url = get_option('fastbots_chatbot_embed_code');
    $bot_id    = get_option('fastbots_chatbot_embed_code_two');

    if ( empty( $embed_url ) || empty( $bot_id ) ) {
        return;
    }

    $safe_url = esc_url( $embed_url );
    if ( empty( $safe_url ) ) {
        return;
    }

    printf(
        '<script defer src="%s" data-bot-id="%s"></script>',
        $safe_url,
        esc_attr( $bot_id )
    );
}

add_action('wp_head', 'fastbots_chatbot_to_header');
