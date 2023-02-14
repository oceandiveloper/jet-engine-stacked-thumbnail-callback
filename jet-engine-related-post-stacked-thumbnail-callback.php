<?php
/**
 * Plugin Name: JetEngine - Related Post Stacked Thumbnail callback
 * Plugin URI:  #
 * Description: Adds new callback to Dynamic Field widget of JetEngine, which allows to return a list of posts thumbnails including post title and permalink to achieve stacked image layout.
 * Version:     1.0.0
 * Author:      Ocean Diveloper
 * Author URI:  https://oceandiveloper.com/
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC'))
{
    die();
}

/**
 * Include CSS file.
 */
function jet_related_post_stacked_thumbnails_scripts() {
    wp_register_style( 'jet_engine_related_post_stacked_thumbnail_callback_styles',  plugin_dir_url( __FILE__ ) . 'assets/style.css' );
    wp_enqueue_style( 'jet_engine_related_post_stacked_thumbnail_callback_styles' );
}
add_action( 'wp_enqueue_scripts', 'jet_related_post_stacked_thumbnails_scripts' );

add_filter('jet-engine/listings/allowed-callbacks', function ($callbacks)
{
    $callbacks['jet_related_post_stacked_thumbnails'] = 'Related post stacked thumbnails';
    return $callbacks;
});

function jet_related_post_stacked_thumbnails($items = [])
{
    $plugin_dir = WP_PLUGIN_DIR . '/jet-engine-related-post-stacked-thumbnail-callback';
    $default_avatar = plugin_dir_url( __FILE__ ).'assets/favicon.jpg';

    if (empty($items))
    {
        
        // $plugin_dir = WP_PLUGIN_DIR . '/jet-engine-related-post-stacked-thumbnail-callback';
        // $default_avatar = plugin_dir_url( __FILE__ ).'assets/favicon.jpg';
        return sprintf('
    	    <div class="jet-rel-list">
                <div class="jet-rel-list__item jet-rel-list__item--default">
                    <img src="%1$s">
                </div>
            </div>', $default_avatar);
    }

    $res = '';

    foreach ($items as $item_id)
    {

        /**
         * The data in example is get for posts.
         * You can replace it with data appropriate for your related items - users, terms etc.
         */
        $title = get_the_title($item_id);
        $thumb = get_the_post_thumbnail($item_id, [150, 150], ['alt' => $title, 'class' => 'jet-rel-list__thumb']);
        $link = get_permalink($item_id);

        $res .= sprintf('
			<div class="jet-rel-list__item">
				<a href="%3$s" class="jet-rel-list__link" title"%1$s">
					%2$s
					<div class="jet-rel-list__title">%1$s</div>
				</a>
			</div>', $title, $thumb, $link);
    }

    $count = count($items);
    $count_output = '';
    $count_list_class = '';
    
    /**
     * The following code will calculate the "+X" based on 4 visible items including the "+" item
     * You can replace the value of $visible_items with your own number of visible items
     */
    $visible_items = 4;
    if ($count > $visible_items)
    {
        $count_calc = $count - $visible_items + 1;
        $count_output = '<div class="jet-rel-list__item jet-rel-list__item--count">+' . $count_calc . '</div>';
        $count_list_class = ' jet-rel-list--plus';
    }

    return sprintf('
	    <div class="jet-rel-list%1$s">
            %2$s
            %3$s
        </div>', $count_list_class, $res, $count_output);
}
