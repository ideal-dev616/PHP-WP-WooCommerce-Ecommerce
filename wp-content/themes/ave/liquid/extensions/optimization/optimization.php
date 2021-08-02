<?php
/**
 * Class for "Optimization"
 */

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

if (!class_exists('Liquid_Optimization')) :
    /**
     * Liquid Disable Unused Scripts
     */
    class Liquid_Optimization extends Liquid_Base
    {

        /**
         * Current Page ID
         * @var $page_id
         */
        public $page_id;

        /**
         * @method __construct
         */
        public function __construct()
        {
            $this->init_hooks();
        }

        /**
         * Init Hooks and Filters
         *
         * @method init_hooks
         */
        private function init_hooks()
        {
            if (is_admin() || (function_exists('vc_is_inline') && vc_is_inline())) {
                $this->add_action('save_post', 'save_post', 10, 2);
            } else {
                $this->add_action('wp', 'wp');
                $this->add_filter('the_content', 'check_content', 0);
                $this->add_action('wp_enqueue_scripts', 'wp_enqueue_scripts');
            }
        }

        /**
         * @method wp
         */
        public function wp()
        {
            $this->page_id = get_the_ID();
        }

        /**
         * WP Enqueue Scripts
         *
         * @method wp_enqueue_scripts
         */
        public function wp_enqueue_scripts()
        {
            if (!has_blocks()) {
                wp_dequeue_style('wp-block-library');
                wp_dequeue_style('wp-block-library-theme');
                wp_dequeue_style('wc-block-style');
            }
        }

        /**
         * Hook Save Post
         *
         * @param $post_ID
         * @param $post
         *
         * @method save_post
         */
        public function save_post($post_ID, $post)
        {

            if (class_exists('WPBMap')) {
                WPBMap::addAllMappedShortcodes();
            }

            add_filter('wp_get_attachment_image_attributes', 'liquid_filter_gallery_img_atts', 10, 2);

            global $shortcode_tags;

            $content = $post->post_content;
            $ignore_html = false;

            if (false === strpos($content, '[')) {
                return;
            }

            if (empty($shortcode_tags) || !is_array($shortcode_tags)) {
                return;
            }

            $tagnames = [
                'vc_row',
                'vc_row_inner',
                'vc_column',
                'vc_column_inner',
                'vc_single_image',
                'vc_column_text',
                'vc_separator',

                'vc_accordion',
                'vc_accordion_tab',
                'ld_animated_frame',
                'ld_animated_frames_container',
                'ld_asymmetric_slider',

                'ld_bananas',
                'ld_bananas_banner',
                'ld_button',

//              'ld_carousel',
//              'ld_carousel_3d',
//              'ld_carousel_falcate',
//              'ld_carousel_gallery',
//              'ld_carousel_marquee',
//              'ld_carousel_stack',
//				'ld_carousel_tab',

//              'ld_content_box',
                'ld_countdown',
                'ld_counter',
                'ld_custom_menu',

                'ld_d_banner',
                'ld_d_depth_banner',
                'ld_distorse_gallery',

                'ld_fancy_heading',
//				'ld_flipbox',
                'ld_freakin_image',
                'ld_fullproj',

                'ld_google_map',

                'ld_highlight',
                'ld_hotspots',

                'ld_icon',
                'ld_icon_box',
                'ld_icon_box_circle',
                'ld_icon_box_circle_item',
                'ld_image_overlay_text',
                'ld_image_text_slider',
                'ld_imgtxt_slider',
                'ld_image_trail',
                'ld_images_comparison',
                'ld_images_group_container',
                'ld_images_group_element',

                'ld_list',

                'ld_masked_image',
                'ld_media',
                'ld_media_element',
                'ld_message',
                'ld_milestone',
                'ld_modal_window',

                'ld_newsletter',

                'ld_particles',
                'ld_pointer_tooltip',
                'ld_price_table',
                'ld_process_box',
                'ld_process_box_container',
                'ld_progressbar',
                'ld_promo',

                'ld_roadmap',
                'ld_roadmap_item',

                'ld_section_title',
                'ld_shop_banner',
//				'ld_slideshow',
//				'ld_slideshow_2',
                'ld_social_icons',
                'ld_spacer',
                'ld_span',

//				'ld_tabs',
                'ld_team_member',
                'ld_team_members_circular',
                'ld_testi_carousel',
//              'ld_testimonial',
                'ld_timeline',
                'ld_timeline_item',
                'ld_tooltiped_image',
                'ld_typewriter',
            ];

            preg_match_all('@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches);

            if (!empty($matches)) {
                $matches = $matches[1];

                foreach ($matches as $match_key => $match_val) {
                    if ($match_val === 'ld_carousel' && $matches[$match_key + 1] === 'vc_row_inner') {
                        if (array_search('vc_row_inner', $tagnames) !== false) {
                            unset($tagnames[array_search('vc_row_inner', $tagnames)]);
                            unset($tagnames[array_search('vc_column_inner', $tagnames)]);
                        }
                    }
                }
            }

            foreach ($shortcode_tags as $tag => $shortcode) {

                if (array_search($tag, $tagnames) === false) {
                    unset($shortcode_tags[$tag]);
                }

            }

            $tagnames = array_intersect(array_keys($shortcode_tags), $tagnames);

            if (empty($tagnames)) {
                return;
            }

            $content = do_shortcodes_in_html_tags($content, $ignore_html, $tagnames);

            $pattern = get_shortcode_regex($tagnames);
            $content = preg_replace_callback("/$pattern/", 'do_shortcode_tag', $content);

            $content = unescape_invalid_shortcodes($content);

            update_post_meta($post_ID, '_post_content', stripslashes($content));

        }

        /**
         * Check generate HTML content
         *
         * @param string $content
         *
         * @method check_content
         *
         * @return mixed|string
         */
        public function check_content(string $content)
        {

            if (!in_the_loop()) {
                return $content;
            }

            if (get_the_ID() !== $this->page_id) {
                return $content;
            }

            $post_ID = $this->page_id;

            $scripts_from_meta = get_post_meta($post_ID, '_post_scripts', true);
            $content_from_meta = get_post_meta($post_ID, '_post_content', true);

            if (is_array($scripts_from_meta)) {
                foreach ($scripts_from_meta as $handle) {
                    wp_enqueue_script($handle);
                }
            }

            if ($content_from_meta) {

                remove_action('the_content', 'wpautop');
                remove_action('the_content', 'wptexturize');

                $content = $content_from_meta;

            }

            return $content;
        }

    }

    new Liquid_Optimization();

endif;