<?php

// phpcs:disable WordPress.WP.EnqueuedResources

namespace Roots\Soil\Tests\Unit\Modules;

use Roots\Soil\Modules\CleanUpModule;
use Roots\Soil\Tests\TestCase;

use function Brain\Monkey\Functions\stubs;
use function Brain\Monkey\Functions\when;

class CleanUpModuleTest extends TestCase
{
    /** @test */
    public function it_should_clean_up_language_attributes()
    {
        $module = new CleanUpModule();
        when('get_bloginfo')->justReturn('en-US');

        when('is_rtl')->justReturn(false);
        $attributes = $module->languageAttributes();
        $this->assertEquals('lang="en-US"', $attributes);

        when('is_rtl')->justReturn(true);
        $attributes = $module->languageAttributes();
        $this->assertEquals('dir="rtl" lang="en-US"', $attributes);
    }

    /** @test */
    public function it_should_clean_stylesheet_links_with_empty_media_attribute()
    {
        $module = new CleanUpModule();

        $link = "<link rel='stylesheet' id='wp-block-library-css'  href='http://example.test/wp/wp-includes/css/dist/block-library/style.css?ver=5.5' media='' />";

        $this->assertEquals(
            '<link rel="stylesheet" href="http://example.test/wp/wp-includes/css/dist/block-library/style.css?ver=5.5">',
            $module->cleanStylesheetLinks($link)
        );
    }

    /** @test */
    public function it_should_clean_stylesheet_links_with_missing_media_attribute()
    {
        $module = new CleanUpModule();

        $link = "<link rel='stylesheet' id='wp-block-library-css'  href='http://example.test/wp/wp-includes/css/dist/block-library/style.css?ver=5.5' />";

        $this->assertEquals(
            '<link rel="stylesheet" href="http://example.test/wp/wp-includes/css/dist/block-library/style.css?ver=5.5">',
            $module->cleanStylesheetLinks($link)
        );
    }

    /** @test */
    public function it_should_clean_stylesheet_links_with_all_media_attribute()
    {
        $module = new CleanUpModule();

        $link = "<link rel='stylesheet' id='wp-block-library-css'  href='http://example.test/wp/wp-includes/css/dist/block-library/style.css?ver=5.5' media='all' />";

        $this->assertEquals(
            '<link rel="stylesheet" href="http://example.test/wp/wp-includes/css/dist/block-library/style.css?ver=5.5">',
            $module->cleanStylesheetLinks($link)
        );
    }

    /** @test */
    public function it_should_clean_stylesheet_links_with_print_media_attribute()
    {
        $module = new CleanUpModule();

        $link = "<link rel='stylesheet' id='wp-block-library-css'  href='http://example.test/wp/wp-includes/css/dist/block-library/style.css?ver=5.5' media='print' />";

        $this->assertEquals(
            '<link rel="stylesheet" href="http://example.test/wp/wp-includes/css/dist/block-library/style.css?ver=5.5" media="print">',
            $module->cleanStylesheetLinks($link)
        );
    }

    /** @test */
    public function it_should_clean_script_tags()
    {
        $module = new CleanUpModule();

        $script = "<script src='http://example.test/wp/wp-content/themes/twentytwenty/assets/js/index.js?ver=1.3' id='twentytwenty-js-js' async></script>";

        $this->assertEquals(
            '<script src="http://example.test/wp/wp-content/themes/twentytwenty/assets/js/index.js?ver=1.3" async></script>',
            $module->cleanScriptTags($script)
        );
    }

    /** @test */
    public function it_should_clean_body_classes_for_front_page()
    {
        $module = new CleanUpModule();
        stubs([
            'is_single' => false,
            'is_page' => true,
            'is_front_page' => true,
            'get_option' => '4',
            'get_permalink' => 'http://example.test/'
        ]);
        $classes = ['foobar', 'page-template-default', 'page-id-4'];

        $this->assertEquals(['foobar'], $module->bodyClass($classes));
    }

    /** @test */
    public function it_should_clean_body_classes_for_pages()
    {
        $module = new CleanUpModule();
        stubs([
            'is_single' => false,
            'is_page' => true,
            'is_front_page' => false,
            'get_permalink' => 'http://example.test/about-us'
        ]);
        $classes = ['foobar', 'page-template-default'];

        $this->assertEquals(['foobar', 'about-us'], $module->bodyClass($classes));
    }

    /** @test */
    public function it_should_clean_body_classes_for_posts()
    {
        $module = new CleanUpModule();
        stubs([
            'is_single' => true,
            'is_page' => false,
            'is_front_page' => false,
            'get_permalink' => 'http://example.test/my-first-blog-post'
        ]);
        $classes = ['foobar', 'page-template-default'];

        $this->assertEquals(['foobar', 'my-first-blog-post'], $module->bodyClass($classes));
    }

    /** @test */
    public function it_should_remove_default_site_tagline()
    {
        $module = new CleanUpModule();

        $this->assertEquals('', $module->removeDefaultSiteTagline('Just another WordPress site'));
        $this->assertEquals('foobar', $module->removeDefaultSiteTagline('foobar'));
    }

    /** @test */
    public function it_should_remove_self_closing_tags()
    {
        $module = new CleanUpModule();

        $this->assertEquals('<img ...>', $module->removeSelfClosingTags('<img ... />'));
    }
}
