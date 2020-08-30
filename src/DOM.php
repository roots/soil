<?php

namespace Roots\Soil;

use DOMDocument;
use DOMNodeList;
use DOMXPath;

class DOM
{
    /**
     * The root document.
     *
     * @var DOMDocument
     */
    protected $doc;

    /**
     * Create a new DOM instance.
     *
     * @param string $html
     * @return void
     */
    public function __construct($html)
    {
        $this->doc = new DOMDocument();

        // use LibXML internal error handler to prevent errors from bubbling to PHP
        libxml_use_internal_errors(true);
        $this->doc->loadHTML('<?xml encoding="UTF-8">' . $html, \LIBXML_HTML_NOIMPLIED | \LIBXML_HTML_NODEFDTD);
        libxml_clear_errors(); // clear all libxml errors
    }

    /**
     * Executes callback on each DOMElement.
     *
     * @param callable $callback
     * @return DOM
     */
    public function each($callback)
    {
        foreach ($this->xpath('//*') as $node) {
            $callback($node);
        }

        return $this;
    }

    /**
     * Evaluates the given XPath expression
     *
     * @param string $expression The XPath expression to execute.
     * @return DOMNodeList
     */
    public function xpath($expression)
    {
        return (new DOMXPath($this->doc))->query($expression);
    }

    /**
     * Save the document HTML.
     *
     * @return string
     */
    public function html()
    {
        // Note: 23 = strlen('<?xml encoding="UTF-8">')
        return trim(substr($this->doc->saveHTML(), 23));
    }

    /** {@inheritdoc} */
    public function __call($name, $arguments)
    {
        return $this->doc->{$name}(...$arguments);
    }

    /** {@inheritdoc} */
    public function __get($name)
    {
        return $this->doc->{$name};
    }
}
