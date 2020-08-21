<?php

namespace Roots\Soil\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Roots\Soil\DOM;

class DomTest extends TestCase
{
    /** @test */
    public function it_should_iterate_all_nodes()
    {
        $doc = new DOM('
            <span>foo</span>
            <span>bar</span>
            <span>biz</span>
            <span>baz</span>
        ');

        $count = 0;

        $doc->each(function () use (&$count) {
            $count++;
        });

        $this->assertEquals(4, $count);
    }

    /** @test */
    public function it_evaluate_xpath_expression()
    {
        $doc = new DOM('
            <span>foo</span>
            <span>bar</span>
            <span>biz</span>
            <span>baz</span>
        ');

        $count = $doc->xpath('//span')->length;

        $this->assertEquals(4, $count);
    }

    /** @test */
    public function it_proxies_domdoc_object()
    {
        /** @var \DOMDocument */
        $doc = new DOM('<span id="foo">foo</span>');

        $node = $doc->getElementById('foo');
        $this->assertEquals('span', $node->tagName);

        $node = $doc->lastChild;
        $this->assertEquals('span', $node->tagName);
    }

    /** @test */
    public function it_returns_modified_html()
    {
        $doc = new DOM('<span id="foo">foo</span>');

        $node = $doc->getElementById('foo');

        $node->setAttribute('id', 'bar');

        $this->assertEquals('<span id="bar">foo</span>', $doc->html());
    }
}
