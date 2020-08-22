<?php

namespace Roots\Soil\Modules;

use DOMDocument;
use Roots\Soil\DOM;

use function add_action;
use function add_filter;
use function esc_url;
use function get_bloginfo;
use function get_default_feed;
use function get_feed_link;
use function get_option;
use function get_permalink;
use function is_front_page;
use function is_page;
use function is_rtl;
use function is_single;
use function remove_action;
use function __;

/**
 * Clean up wp_head()
 *
 * Remove unnecessary <link>'s
 * Remove inline CSS and JS from WP emoji support
 * Remove inline CSS used by Recent Comments widget
 * Remove inline CSS used by posts with galleries
 * Remove self-closing tag
 */
class CleanUpModule extends AbstractModule
{
    /**
     * Name of the module.
     *
     * @var string
     */
    protected $name = 'clean-up';

    /**
     * Module handle.
     *
     * @return void
     */
    public function handle()
    {
        $this->filter('init', 'headCleanup');
        $this->filter('language_attributes', 'languageAttributes');
        $this->filter('body_class', 'bodyClass');
        $this->filter('embed_oembed_html', 'embedWrap');
        $this->filter('get_bloginfo_rss', 'removeDefaultSiteTagline');

        $this->filters([
            'get_avatar',          // <img />
            'comment_id_fields',   // <input />
            'post_thumbnail_html'  // <img />
        ], 'removeSelfClosingTags');

        if (class_exists(DOMDocument::class)) {
            $this->filter('style_loader_tag', 'cleanStylesheetLinks');
            $this->filter('script_loader_tag', 'cleanScriptTags');
        }

        $this->removeCommentsFeed();
        $this->removeWordPressVersionFromRssFeeds();
    }

    /**
     * Clean up output <head> section.
     *
     * @internal Used by `init`
     *
     * @link https://wpengineer.com/1438/wordpress-header/
     *
     * @return void
     */
    public function headCleanup()
    {
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wp_shortlink_wp_head', 10);
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        add_filter('use_default_gallery_style', '__return_false');
        add_filter('emoji_svg_url', '__return_false');
        add_filter('show_recent_comments_widget_style', '__return_false');
    }

    /**
     * Remove comments feed from <head>.
     *
     * @return void
     */
    public function removeCommentsFeed()
    {
        add_action('wp_head', 'ob_start', 1, 0);
        add_action('wp_head', function () {
            $pattern = '/.*' . preg_quote(esc_url(get_feed_link('comments_' . get_default_feed())), '/') . '.*[\r\n]+/';
            echo preg_replace($pattern, '', ob_get_clean());
        }, 3, 0);
    }

    /**
     * Remove the WordPress version from RSS feeds.
     *
     * @return void
     */
    public function removeWordPressVersionFromRssFeeds()
    {
        add_filter('the_generator', '__return_false');
    }

    /**
     * Clean up language_attributes() used in <html> tag
     *
     * Remove dir="ltr"
     *
     * @internal Used by `language_attributes`
     *
     * @return void
     */
    public function languageAttributes()
    {
        $attributes = [];

        if (is_rtl()) {
            $attributes[] = 'dir="rtl"';
        }

        $lang = get_bloginfo('language');

        if ($lang) {
            $attributes[] = "lang=\"{$lang}\"";
        }

        return implode(' ', $attributes);
    }

    /**
     * Clean up output of stylesheet <link> tags
     *
     * @internal Used by `style_loader_tag`
     *
     * @param string $html
     * @return string
     */
    public function cleanStylesheetLinks($html)
    {
        return (new DOM($html))->each(static function ($link) {
            $link->removeAttribute('type');
            $link->removeAttribute('id');

            if (($media = $link->getAttribute('media')) && $media !== 'all') {
                return;
            }

            $link->removeAttribute('media');
        })->html();
    }

    /**
     * Clean up output of <script> tags
     *
     * @internal Used by `script_loader_tag`
     *
     * @param string $html
     * @return string
     */
    public function cleanScriptTags($html)
    {
        return (new DOM($html))->each(static function ($script) {
            $script->removeAttribute('type');
            $script->removeAttribute('id');
        })->html();
    }

    /**
     * Add and remove body_class() classes.
     *
     * @internal Used by `body_class`
     *
     * @param array $classes
     * @return array
     */
    public function bodyClass($classes)
    {
        $remove_classes = [
            'page-template-default'
        ];

        // Add post/page slug if not present
        if (is_single() || is_page() && !is_front_page()) {
            if (!in_array($slug = basename(get_permalink()), $classes)) {
                $classes[] = $slug;
            }
        }

        if (is_front_page()) {
            $remove_classes[] = 'page-id-' . get_option('page_on_front');
        }

        $classes = array_values(array_diff($classes, $remove_classes));

        return $classes;
    }

    /**
     * Remove the default site tagline from RSS feed.
     *
     * @internal Used by `get_bloginfo_rss`
     *
     * @param string $bloginfo
     * @return string
     */
    public function removeDefaultSiteTagline($bloginfo)
    {
        $default_tagline = __('Just another WordPress site');
        return ($bloginfo === $default_tagline) ? '' : $bloginfo;
    }

    /**
     * Remove self-closing tags.
     *
     * @internal Used by `get_avatar`, `comment_id_fields`, and `post_thumbnail_html`
     *
     * @param string $html
     * @return string
     */
    public function removeSelfClosingTags($html)
    {
        return str_replace(' />', '>', $html);
    }
}
